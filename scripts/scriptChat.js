const perguntas = [
    'Olá! Vamos começar? Nenhuma resposta ficará registrada ou será compartilhada.',
    'Pode me enviar uma foto do seu rosto?',
    'Poderia descrever sua face e tom de pele?',
    'Para qual ocasião você está se preparando?',
    'Qual horário será o evento?',
    'Tem alguma preferência pessoal de maquiagem? Ex: natural, dramática, clássica, etc.',
    'Gostaria de receber sugestões dos nossos produtos para montar o look?'
];

let perguntaAtual = 0;
let respostas = [];
let fotoSelecionada = false;

function mostrarControles() {
    const controles = document.getElementById('controles');

    switch (perguntaAtual) {
        case 0:
            controles.innerHTML = `
                <div class="d-flex justify-content-evenly mt-2">
                    <button type="submit" class="btn btn-primary">Vamos começar!</button>
                </div>`;
            break;
        case 1:
            controles.innerHTML = `
                <input id="descricao" name="descricao" type="file" accept="image/*" class="form-control" required>
                <div class="d-flex justify-content-evenly mt-2">
                    <button type="submit" class="btn btn-secondary" data-pular="true" formnovalidate>Pular</button>
                    <button type="submit" class="btn btn-primary" onClick="fotoEnviada()">Enviar foto</button>
                </div>`;
                break;
        case 2:
            controles.innerHTML = `
                <input id="descricao" name="descricao" type="text" class="form-control" placeholder="Ex.: pele clara, olhos castanhos, cabelo loiro" required>
                <div class="d-flex justify-content-evenly mt-2">
                    <button type="submit" class="btn btn-secondary" data-pular="true" formnovalidate>Pular</button>
                    <button type="submit" class="btn btn-primary">Continuar</button>
                </div>`;
                
            break;
        case 3:
            controles.innerHTML = `
                <input id="descricao" name="descricao" type="text" class="form-control" placeholder="Ex.: casamento, festa, trabalho" required>
                <div class="d-flex justify-content-evenly mt-2">
                    <button type="submit" class="btn btn-secondary" data-pular="true" formnovalidate>Pular</button>
                    <button type="submit" class="btn btn-primary">Continuar</button>
                </div>`;
            break;
        case 4:
            controles.innerHTML = `
                <input id="descricao" name="descricao" type="time" class="form-control" required>
                <div class="d-flex justify-content-evenly mt-2">
                    <button type="submit" class="btn btn-secondary" data-pular="true" formnovalidate>Pular</button>
                    <button type="submit" class="btn btn-primary">Continuar</button>
                </div>`;
            break;
        case 5:
            controles.innerHTML = `
                <input id="descricao" name="descricao" type="text" class="form-control" placeholder="Ex.: natural" required>
                <div class="d-flex justify-content-evenly mt-2">
                    <button type="submit" class="btn btn-secondary" data-pular="true" formnovalidate>Pular</button>
                    <button type="submit" class="btn btn-primary">Continuar</button>
                </div>`;
            break;
        case 6:
            controles.innerHTML = `
                <div class="d-flex justify-content-evenly mt-2">
                    <button type="submit" class="btn btn-outline-success" data-resposta="Sim">Sim</button>
                    <button type="submit" class="btn btn-outline-secondary" data-resposta="Não">Não</button>
                </div>`;
            break;
        case 7:
            controles.innerHTML = `
                <div class="d-flex justify-content-evenly mt-2">
                    <button type="button" id="reiniciar" class="btn btn-primary">Reiniciar conversa</button>
                </div>`;
            controles.querySelector('#reiniciar').addEventListener('click', reiniciarConversa);
            break;
    }
}

function mostrarPergunta() {
    adicionarMensagem(perguntas[perguntaAtual], 'recebida');
    mostrarControles();
    rolarParaBaixo();
    console.log(perguntaAtual);
}

function rolarParaBaixo() {
    requestAnimationFrame(() => {
        window.scrollTo({
            top: document.documentElement.scrollHeight,
            behavior: 'smooth'
        });
    });
}

function fotoEnviada() {
    fotoSelecionada = true;
}

document.addEventListener('DOMContentLoaded', mostrarPergunta);

document.getElementById('resposta').addEventListener('submit', async function (event) {
    event.preventDefault();

    const campo = document.getElementById('descricao');
    const botaoSelecionado = event.submitter?.dataset.resposta;
    const resposta = event.submitter?.dataset.pular ? 'Pergunta pulada' : perguntaAtual === 0 ? 'Vamos começar!' : botaoSelecionado || (campo.type === 'file'
        ? (campo.files[0]?.name || '')
        : campo.value.trim());

    adicionarMensagem(resposta, 'enviada');
    respostas.push({
        pergunta: perguntas[perguntaAtual],
        resposta: resposta
    });
    

    perguntaAtual++;
    if(fotoSelecionada) {
        perguntaAtual++;
    }

    if (perguntaAtual < perguntas.length) {
        mostrarPergunta();
    } else {
        await enviarParaIa();
    }
});

async function enviarParaIa() {
    const controles = document.getElementById('controles');
    const dados = new FormData();
    dados.append('descricao', respostas.map(item =>
        `${item.pergunta}\nResposta: ${item.resposta}`
    ).join('\n\n'));

    controles.innerHTML = '<p class="text-muted"><span class="loading-icon" aria-hidden="true"><i class="bi bi-arrow-repeat"></i></span> Preparando sua recomendação...</p>';
    rolarParaBaixo();

    try {
        const inicioCarregamento = Date.now();
        const respostaApi = await fetch('../scriptsPHP/upload.php', {
            method: 'POST',
            body: dados
        });
        const textoIa = await respostaApi.text();
        const tempoRestante = 500 - (Date.now() - inicioCarregamento);

        if (tempoRestante > 0) {
            await new Promise(resolve => setTimeout(resolve, tempoRestante));
        }

        // tenta converter a resposta da API (texto) em objeto JSON
        let data;
        try {
            data = JSON.parse(textoIa);
        } catch (erroParse) {
            console.error('Resposta não é um JSON válido:', textoIa);
            adicionarMensagem('Não foi possível obter a recomendação agora.', 'recebida');
            mostrarControlesFinal();
            rolarParaBaixo();
            return;
        }

        // o upload.php pode devolver { erro: "..." } em vez do look completo
        if (data.erro) {
            console.error('Erro retornado pelo upload.php:', data.erro);
            adicionarMensagem('Não foi possível obter a recomendação agora.', 'recebida');
            mostrarControlesFinal();
            rolarParaBaixo();
            return;
        }

        // quebra o JSON em mensagens e envia uma por vez
        const mensagens = jsonParaMensagens(data);
        await enviarMensagensSequencial(mensagens, document.getElementById('chat-container'));

    } catch (erro) {
        adicionarMensagem('Não foi possível obter a recomendação agora.', 'recebida');
    }

    mostrarControlesFinal();
    rolarParaBaixo();
}

function jsonParaMensagens(data) {
    const mensagens = [];

    mensagens.push({
        tipo: 'intro',
        lookName: data.nome_do_look,
        texto: data.analise_inicial
    });

    data.passo_a_passo.forEach((passo, i) => {
        mensagens.push({
            tipo: 'etapa',
            numero: i + 1,
            titulo: passo.etapa,
            texto: passo.instrucao
        });
    });

    mensagens.push({
        tipo: 'produtos',
        produtos: data.produtos_recomendados
    });

    mensagens.push({
        tipo: 'dica',
        texto: data.dica_extra
    });

    return mensagens;
}

// monta o HTML interno de cada bolha, de acordo com o tipo da mensagem
function criarConteudoMensagem(msg) {
    if (msg.tipo === 'intro') {
        return `<strong>${msg.lookName}</strong><p class="mb-0 mt-1">${msg.texto}</p>`;
    }
    if (msg.tipo === 'etapa') {
        return `<strong>${msg.numero}. ${msg.titulo}</strong><p class="mb-0 mt-1">${msg.texto}</p>`;
    }
    if (msg.tipo === 'produtos') {
        const itens = msg.produtos.map(p =>
            `<div class="mt-2"><strong>${p.nome_do_produto}</strong><br><span class="text-muted" style="font-size:0.85rem;">${p.motivo}</span></div>`
        ).join('');
        return `<strong>Produtos para este look</strong>${itens}`;
    }
    if (msg.tipo === 'dica') {
        return `<span class="text-muted">💡 ${msg.texto}</span>`;
    }
    return '';
}

// bolha temporária de "digitando..." exibida entre uma mensagem e outra
function mostrarDigitando(container) {
    const el = document.createElement('div');
    el.id = 'digitando';
    el.className = 'card bg-light text-dark border-0 rounded-4 rounded-start-0 p-3 shadow-sm me-auto mb-3';
    el.style.maxWidth = '75%';
    el.innerHTML = '<span class="text-muted">digitando...</span>';
    container.appendChild(el);
    rolarParaBaixo();
}

function removerDigitando(container) {
    document.getElementById('digitando')?.remove();
}

// envia as mensagens uma de cada vez, com uma pequena pausa entre elas
async function enviarMensagensSequencial(mensagens, container) {
    for (const msg of mensagens) {
        mostrarDigitando(container);
        await esperar(700 + Math.random() * 500); // 700–1200ms, parece mais natural
        removerDigitando(container);
        adicionarMensagem(criarConteudoMensagem(msg), 'recebida');
        rolarParaBaixo();
    }
}

function esperar(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

function mostrarControlesFinal() {
    perguntaAtual = 7;
    mostrarControles();
}

function reiniciarConversa() {
    perguntaAtual = 0;
    respostas = [];
    document.getElementById('chat-container').innerHTML = '';
    mostrarPergunta();
}

function adicionarMensagem(texto, tipo) {
    const chatContainer = document.getElementById('chat-container');
    let msg = '';

    if (tipo === 'enviada') {
        msg = `
            <div class="card bg-success bg-opacity-25 text-dark border-0 rounded-4 rounded-end-0 rounded-end-lg-4 p-3 shadow-sm ms-auto mb-3" style="max-width: 75%;">
              <p class="mb-1 text-break">${texto}</p>
            </div>`;
        
    } else {
        msg = `
            <div class="card bg-light text-dark border-0 rounded-4 rounded-start-0 p-3 shadow-sm me-auto mb-3" style="max-width: 75%;">
              <p class="mb-1 text-break">${texto}</p>
            </div>`;
    }
    chatContainer.insertAdjacentHTML('beforeend', msg);
}