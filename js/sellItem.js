function exibirImagem(input) {
    if (input.files && input.files[0]) {
        var read= new FileReader();
        read.onload = function (e) {
            document.getElementById('imagemExibida').src = e.target.result;
            document.getElementById('imagemExibida').style.display = 'block';
            document.getElementById('labelFoto').innerText = 'Change photo';
        };
        read.readAsDataURL(input.files[0]);
    }
}
