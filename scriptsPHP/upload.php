<?php
// 1. Captura o texto longo enviado pelo formulário
$descricao = isset($_POST['descricao']) ? trim($_POST['descricao']) : '';

// 2. Verifica se a foto foi enviada corretamente
if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
    
    $arquivoTmp = $_FILES['foto']['tmp_name'];
    
    // Descobre o tipo MIME real da imagem (ex: image/jpeg, image/png)
    $tipoMime = mime_content_type($arquivoTmp);
    
    // Converte a imagem da memória temporária para Base64
    $dadosBinarios = file_get_contents($arquivoTmp);
    $imagemBase64 = base64_encode($dadosBinarios);

    // ==========================================
    // 3. INTEGRAÇÃO COM A API DO GEMINI
    // ==========================================
    
    $apiKey = "SUA_CHAVE_DE_API_DO_GEMINI"; // Substitua pela sua chave do Google AI Studio
    
    // Usamos um modelo multimodal como o gemini-1.5-flash ou gemini-1.5-pro
    $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=" . $apiKey;

    // Monta o payload (os dados que serão enviados para a IA)
    $payload = [
        "contents" => [
            [
                "parts" => [
                    ["text" => $descricao], // O texto longo do usuário
                    [
                        "inline_data" => [
                            "mime_type" => $tipoMime,
                            "data" => $imagemBase64 // A imagem em base64 vinda direto da memória
                        ]
                    ]
                ]
            ]
        ]
    ];

    // Configura a requisição cURL
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));

    // Executa a requisição
    $respostaApi = curl_exec($ch);
    $erroCurl = curl_error($ch);
    curl_close($ch);

    // ==========================================
    // 4. TRATAMENTO DA RESPOSTA DA IA
    // ==========================================
    if ($erroCurl) {
        echo "Erro de conexão com a API: " . $erroCurl;
    } else {
        $resultado = json_decode($respostaApi, true);
        
        // Extrai a resposta de texto gerada pelo Gemini
        $respostaIa = $resultado['candidates'][0]['content']['parts'][0]['text'] ?? 'Não foi possível obter resposta da IA.';

        // Exibe o resultado na tela para o usuário
        echo "<h2>Resposta da IA:</h2>";
        echo "<div style='background: #f4f4f4; padding: 15px; border-radius: 5px;'>";
        echo nl2br(htmlspecialchars($respostaIa));
        echo "</div>";
    }

} else {
    echo "Erro: Nenhuma imagem foi enviada ou ocorreu um erro no upload.";
}
?>