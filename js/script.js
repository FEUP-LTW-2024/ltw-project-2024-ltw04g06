document.addEventListener('DOMContentLoaded', function() { 
const showFormButton = document.getElementById('showFormButton');
const elementToToggle = document.getElementById('elementToToggle');

    showFormButton.addEventListener('click', () => {
        if (elementToToggle.style.display == 'none') elementToToggle.style.display = 'block';
        else elementToToggle.style.display = 'none';
    });

    document.querySelectorAll('.radio-btn').forEach(function(radio) {
        radio.addEventListener('click', function() {
            var selectedUserID = this.value;
            var xhr = new XMLHttpRequest();
            xhr.open('GET', '/../templates/ajaxHandler.php?action=messageBox&userID=' + selectedUserID, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    document.querySelector('.mensagem').innerHTML = xhr.responseText;
                    scrollDown();
                    Give();
                }
            };
            xhr.send();
        });
    });
    
});

function scrollDown(){
    var caixaDeMensagens = document.getElementById("caixaDeMensagens");
    caixaDeMensagens.scrollTop = caixaDeMensagens.scrollHeight;
}

function Give(){
    document.querySelector('.send_message').addEventListener('click', function() {
        var formData = new FormData(document.getElementById('messageForm'));
        document.getElementById('messageContent').value = '';
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '/../actions/action_message.php', true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                const tempElement = document.createElement('div');
                tempElement.innerHTML = xhr.responseText;
                document.querySelector('.conjunto').appendChild(tempElement);
                scrollDown();
            }
        };
        xhr.send(formData); 
    });
}





  
