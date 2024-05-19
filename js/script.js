document.addEventListener('DOMContentLoaded', function() { 
    // To form on top appear on click
    const showFormButton = document.getElementById('showFormButton');
    const elementToToggle = document.getElementById('elementToToggle');
    showFormButton.addEventListener('click', () => {
        if (elementToToggle.style.display == 'none') elementToToggle.style.display = 'block';
        else elementToToggle.style.display = 'none';
    });

    // To change the message box when we change de person
    document.querySelectorAll('.radio-btn').forEach(function(radio) {
        if (radio.checked) {
            var selectedUserID = radio.value;
            var xhr = new XMLHttpRequest();
            xhr.open('GET', '/../actions/ajaxHandler.php?action=messageBox&userID=' + selectedUserID, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    document.querySelector('.mensagem').style.display = 'block';
                    document.querySelector('.mensagem').innerHTML = xhr.responseText;
                    scrollDown();
                    Give();
                }
            };
            xhr.send();
        }
        radio.addEventListener('click', function() {
            var selectedUserID = this.value;
            var xhr = new XMLHttpRequest();
            xhr.open('GET', '/../actions/ajaxHandler.php?action=messageBox&userID=' + selectedUserID, true);
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

    // To change the type of setting we are in
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

    // To change the condition of products we are seeing in profile
    var c = document.getElementById('condition');
    if (c != null) {
        c.addEventListener('change', () => {
            var selectedCondition = document.getElementById('condition').value;
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        document.getElementById('prodShow').innerHTML = xhr.responseText;
                    }
                }
            };
            xhr.open('GET', '/../actions/action_active_or_sold.php?condition=' + selectedCondition + '&userID=' + parseInt(document.getElementById('userID').innerText), true);
            xhr.send();
        });
    }

    // To change the condition of products we are seeing in Seeprofile
    var c = document.getElementById('conditionSeeP');
    if (c != null) {
        c.addEventListener('change', () => {
            var selectedCondition = document.getElementById('conditionSeeP').value;
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        document.getElementById('prodShowSeeP').innerHTML = xhr.responseText;
                    }
                }
            };
            xhr.open('GET', '/../actions/action_active_or_sold_seeP.php?condition=' + selectedCondition + '&userID=' + parseInt(document.getElementById('userID').innerText), true);
            xhr.send();
        });
    }
    // ADD / REMOVE from wishlist
    var wishlistForms = document.querySelectorAll('form[id^="wishlist-form"]');
    wishlistForms.forEach(function(form) {
        var heartButton = form.querySelector('#heart');
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(this);
            console.log(formData.get('itemID'));
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    if (heartButton.classList.contains('red')){
                        heartButton.classList.remove('red');
                    }else{
                        heartButton.classList.add('red');
                    }
                }
            }
        };
        xhr.open('GET', '/../actions/action_add_to_wishlist.php?itemID=' + formData.get('itemID') + '&csrf=' + formData.get('csrf'), true);
        xhr.send();
        });
    });
});

function scrollDown() {
    var caixaDeMensagens = document.getElementById("caixaDeMensagens");
    caixaDeMensagens.scrollTop = caixaDeMensagens.scrollHeight;
}

function Give() {
    document.querySelector('.send_message').addEventListener('click', MessageAdd);
    document.getElementById('messageContent').addEventListener('keypress', function(event) {
        if (event.key === 'Enter') {
            MessageAdd();
        }
    });
}

function MessageAdd() {
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

function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function() {
        var output = document.getElementById('preview');
        output.src = reader.result;
        output.style.display = 'block';
    };
    reader.readAsDataURL(event.target.files[0]);
}
window.addEventListener("beforeunload", function() {
    var selectElement = document.getElementById("condition");
    selectElement.value = "Available";
});
window.addEventListener("beforeunload", function() {
    var selectElement = document.getElementById("conditionSeeP");
    selectElement.value = "Available";
});
