document.getElementById('meu-formulario').addEventListener('submit', function (event) {

    event.preventDefault();

    const form = event.target;
    const formData = new FormData(form);
    const descricaoTexto = formData.get('descricao');

    const formContainer = document.getElementById('form-container');
    const chatContainer = document.getElementById('chat-container');


    formContainer.classList.add('d-none');


    adicionarMensagem(descricaoTexto, 'enviada');


    const loadingId = 'loading-' + Date.now();
    adicionarMensagem('<em>IA está analisando a imagem...</em>', 'recebida', loadingId);


    fetch('../scriptsPHP/upload.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.text()) 
        .then(data => {
            document.getElementById(loadingId).remove();


            adicionarMensagem(data, 'recebida');


        })
        .catch(error => {
            console.error('Erro:', error);
            document.getElementById(loadingId).remove();
            adicionarMensagem('Ocorreu um erro ao processar a imagem.', 'recebida');
        });
});

function adicionarMensagem(texto, tipo, id = null) {
    const chatContainer = document.getElementById('chat-container');
    const horaAtua = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
    const idAttr = id ? `id="${id}"` : '';
    let msgHTML = '';

    if (tipo === 'enviada') {
        msgHTML = `
            <div ${idAttr} class="card bg-success bg-opacity-25 text-dark border-0 rounded-4 rounded-end-0 p-3 shadow-sm ms-auto mb-3" style="max-width: 75%;">
              <p class="mb-1 text-break">${texto}</p>
              <div class="d-flex justify-content-end align-items-center gap-1 text-muted" style="font-size: 0.75rem;">
                <i class="bi bi-check2-all text-primary"></i>
              </div>
            </div>`;
    } else {
        msgHTML = `
            <div ${idAttr} class="card bg-light text-dark border-0 rounded-4 rounded-start-0 p-3 shadow-sm me-auto mb-3" style="max-width: 75%;">
              <p class="mb-1 text-break">${texto}</p>
              <div class="d-flex justify-content-end align-items-center gap-1 text-muted" style="font-size: 0.75rem;">
                <span>${horaAtua}</span>
              </div>
            </div>`;
    }

    chatContainer.insertAdjacentHTML('beforeend', msgHTML);
}