const showFormButton = document.getElementById('showFormButton');
const elementToToggle = document.getElementById('elementToToggle');

    showFormButton.addEventListener('click', () => {
        if (elementToToggle.style.display == 'none') elementToToggle.style.display = 'block';
        else elementToToggle.style.display = 'none';
    });

function scrollDown(){
    var caixaDeMensagens = document.getElementById("caixaDeMensagens");
    caixaDeMensagens.scrollTop = caixaDeMensagens.scrollHeight;
}
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.radio-btn').forEach(function(radio) {
        radio.addEventListener('click', function() {
            var selectedUserID = this.value;
            var xhr = new XMLHttpRequest();
            xhr.open('GET', '/../templates/ajaxHandler.php?action=messageBox&userID=' + selectedUserID, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    document.querySelector('.mensagem').innerHTML = xhr.responseText;
                    scrollDown();
                }
            };
            xhr.send();
        });
    });
});

function openModal() {
    var modal = document.getElementById('modal');
    modal.style.display = 'block';
}
  
function closeModal() {
    var modal = document.getElementById('modal');
    modal.style.display = 'none';
}

document.addEventListener('DOMContentLoaded', function() {
    var caixa = document.querySelector('.addProduct');
    caixa.addEventListener('click', function() {
      openModal();
    });
  });
  
  
