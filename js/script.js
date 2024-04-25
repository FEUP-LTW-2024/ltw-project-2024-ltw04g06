const showFormButton = document.getElementById('showFormButton');
const elementToToggle = document.getElementById('elementToToggle');

    showFormButton.addEventListener('click', () => {
        if (elementToToggle.style.display == 'none') elementToToggle.style.display = 'block';
        else elementToToggle.style.display = 'none';
    });

document.addEventListener("DOMContentLoaded", function() {
    var caixaDeMensagens = document.getElementById("caixaDeMensagens");
    if (caixaDeMensagens) {
        caixaDeMensagens.scrollTop = caixaDeMensagens.scrollHeight - caixaDeMensagens.clientHeight;
    } else {
        console.error("A caixa de mensagens não foi encontrada.");
    }
});
