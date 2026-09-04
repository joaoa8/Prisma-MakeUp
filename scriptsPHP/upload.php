<?php
header('Content-Type: application/json; charset=utf-8');

$descricao = isset($_POST['descricao']) ? trim($_POST['descricao']) : '';

$temImagem = isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK;
$tipoMime = '';
$imagemBase64 = '';

if ($temImagem) {
    $arquivoTmp = $_FILES['foto']['tmp_name'];
    $tipoMime = mime_content_type($arquivoTmp);
    $dadosBinarios = file_get_contents($arquivoTmp);
    $imagemBase64 = base64_encode($dadosBinarios);
}

$apiKey = "AQ.Ab8RN6IhHosRayD9jFaDQmFSGw4_7PnxbNBwyW8FqcyZIODyAQ";

$url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-3.6-flash:generateContent?key=" . $apiKey;

$instrucao = '
Você é uma Maquiadora Profissional e Consultora de Beleza Virtual altamente experiente, empática e criativa. Seu objetivo é analisar as informações fornecidas pelo usuário e criar uma recomendação de maquiagem personalizada, explicando o passo a passo de forma clara e acessível.

### INFORMAÇÕES RECEBIDAS:
Você tem os seguintes dados do usuário:
- Imagem: [Foto do rosto do usuário, se aplicável]
- Descrição da Face e Tom de Pele: [Texto descritivo fornecido pelo usuário]
- Destino/Ocasião: [Para onde o usuário vai]
- Horário: [Dia, tarde, noite]
- Preferências Pessoais: [Cores favoritas, alergias, estilos como "natural", "glamour", etc.]
- Aceita Recomendações de Produtos: [SIM/NÃO]

### REGRAS DE COMPORTAMENTO:
1. Tom de Voz: Seja encorajadora, amigável e profissional. Use uma linguagem que eleve a autoestima do usuário.
2. Personalização: A maquiagem DEVE fazer sentido para o horário e a ocasião. (ex: maquiagem leve com proteção solar para um parque de dia; brilho e contorno marcado para uma balada à noite).
3. Adaptação à Fisionomia: Se o usuário enviar uma foto ou descrição do rosto (ex: "olhos encapuzados", "pele oleosa"), adapte as técnicas de aplicação para valorizar esses traços.
4. Recomendação de Produtos:
   - SE "Aceita Recomendações de Produtos" for SIM: Você DEVE incluir uma lista de produtos recomendados para alcançar o visual. [NOTA: O sistema injetará o catálogo de produtos disponíveis aqui].
   - SE "Aceita Recomendações de Produtos" for NÃO: NÃO mencione marcas ou produtos específicos, foque apenas nos tipos de produtos (ex: "use um blush pêssego", sem citar marca).

### RECOMENDACOES DE PRODUTOS:
Os produtos que podem ser recomendados são extritamente:
-

### FORMATO DE SAÍDA OBRIGATÓRIO (JSON):
Você deve responder EXCLUSIVAMENTE em formato JSON válido, seguindo a estrutura abaixo, sem marcações markdown fora do JSON:

{
  "analise_inicial": "Um breve parágrafo elogiando o usuário e explicando por que o look escolhido é perfeito para a ocasião e horário.",
  "nome_do_look": "Um nome criativo para a maquiagem (ex: Glow Solar de Domingo).",
  "passo_a_passo": [
    {
      "etapa": "Preparação da Pele",
      "instrucao": "Instruções detalhadas..."
    },
    {
      "etapa": "Olhos",
      "instrucao": "Instruções detalhadas..."
    }
  ],
  "produtos_recomendados": [
    {
      "nome_do_produto": "Nome do produto da loja",
      "motivo": "Por que este produto é ideal para o look"
    }
  ],
  "dica_extra": "Uma dica de ouro final (ex: como fazer a maquiagem durar mais)."
}';

$promptCompleto = $instrucao . "\n\nDADOS RESPONDIDOS PELO USUÁRIO:\n" . $descricao;

$payload = [
    "contents" => [
        [
            "parts" => [
                ["text" => $promptCompleto]
            ]
        ]
    ],
    "generationConfig" => [
        "responseMimeType" => "application/json"
    ]
];

if ($temImagem) {
    $payload["contents"][0]["parts"][] = [
        "inline_data" => [
            "mime_type" => $tipoMime,
            "data" => $imagemBase64
        ]
    ];
}

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));

$respostaApi = curl_exec($ch);
$erroCurl = curl_error($ch);
curl_close($ch);

// helper: sempre devolve um JSON válido para o front-end, mesmo em caso de erro
function responderErro(string $mensagem, int $statusHttp = 500): void {
    http_response_code($statusHttp);
    echo json_encode(['erro' => $mensagem], JSON_UNESCAPED_UNICODE);
    exit;
}

if ($erroCurl) {
    responderErro('Erro de conexão com a API: ' . $erroCurl);
}

$resultado = json_decode($respostaApi, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    responderErro('A API retornou uma resposta inválida.');
}

// a API pode bloquear a resposta por segurança, estourar cota, ou outros erros
if (!isset($resultado['candidates'][0]['content']['parts'][0]['text'])) {
    // registra o erro real no log do servidor (não exposto ao usuário final)
    error_log('Erro da API Gemini: ' . json_encode($resultado, JSON_UNESCAPED_UNICODE));

    // se for erro de cota, avisa isso especificamente (ajuda a diagnosticar rápido no futuro)
    if (isset($resultado['error']['status']) && $resultado['error']['status'] === 'RESOURCE_EXHAUSTED') {
        responderErro('Limite diário de uso da IA foi atingido. Tente novamente mais tarde.');
    }

    $motivo = $resultado['promptFeedback']['blockReason'] ?? 'motivo desconhecido';
    responderErro('Não foi possível obter resposta da IA (' . $motivo . ').');
}

$respostaIa = $resultado['candidates'][0]['content']['parts'][0]['text'];

// validação extra: garante que o texto devolvido pela IA é realmente um JSON válido
// antes de repassar para o front-end
$jsonDecodificado = json_decode($respostaIa);
if (json_last_error() !== JSON_ERROR_NONE) {
    responderErro('A IA não retornou um JSON válido.');
}

// devolve o JSON da IA diretamente, sem nenhum HTML em volta
echo $respostaIa;