document.addEventListener('DOMContentLoaded', function() { 
const showFormButton = document.getElementById('showFormButton');
const elementToToggle = document.getElementById('elementToToggle');

    showFormButton.addEventListener('click', () => {
        if (elementToToggle.style.display == 'none') elementToToggle.style.display = 'block';
        else elementToToggle.style.display = 'none';
    });

    document.querySelectorAll('.radio-btn').forEach(function(radio) {
        Give();
        scrollDown();
        radio.addEventListener('click', function() {
            var selectedUserID = this.value;
            var xhr = new XMLHttpRequest();
            xhr.open('GET', '/../templates/ajaxHandler.php?action=messageBox&userID=' + selectedUserID, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    document.querySelector('.mensagem').style.display = 'block';
                    document.querySelector('.mensagem').innerHTML = xhr.responseText;
                    scrollDown();
                    Give();
                }
            };
            xhr.send();
        });
    });
    const links = document.querySelectorAll('.selectSetting a');

    links.forEach(function(link) {
        link.addEventListener('click', function(event) {
            links.forEach(function(link) {
                link.style.color = "black"; 
            });
            this.style.color = "#cc4545"; 
            event.preventDefault();
            const settingType = this.id;
            loadSetting(settingType);
        });
    });

    function loadSetting(settingType) {
        const xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.querySelector('.container').innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "/../actions/action_load_setting.php?type=" + settingType, true);
        xhttp.send();
    }
    document.getElementById('condition').addEventListener('change', ()=>{
        var selectedCondition = document.getElementById('condition').value;
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    document.getElementById('prodShow').innerHTML = xhr.responseText;
                }
            }
        };
        xhr.open('GET', '/../actions/action_active_or_sold.php?condition=' + selectedCondition + 
        '&userID=' + parseInt(document.getElementById('userID').innerText), true);

        xhr.send();
    })
    
});

function scrollDown(){
    var caixaDeMensagens = document.getElementById("caixaDeMensagens");
    caixaDeMensagens.scrollTop = caixaDeMensagens.scrollHeight;
}

function Give(){
    document.querySelector('.send_message').addEventListener('click', MessageAdd);
    document.getElementById('messageContent').addEventListener('keypress', function(event) {
        if (event.key === 'Enter') {
            MessageAdd();
        }
    });
}
function MessageAdd(){
    var formData = new FormData(document.getElementById('messageForm'));
    var mensagem = formData.get('content');
    if (mensagem.trim() === '') return;
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
}





  
