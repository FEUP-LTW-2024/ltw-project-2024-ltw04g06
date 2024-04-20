const showFormButton = document.getElementById('showFormButton');
const elementToToggle = document.getElementById('elementToToggle');


    showFormButton.addEventListener('click', () => {
        if (elementToToggle.style.display == 'none') elementToToggle.style.display = 'block';
        else elementToToggle.style.display = 'none';
    });