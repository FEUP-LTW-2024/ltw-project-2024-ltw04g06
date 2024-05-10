function showImage(input) {
    var images=document.getElementById('imagensExibidas');
    images.innerHTML=''; 
    var top=document.createElement('div');
    top.className='grupo-de-imagens';
    for (var i=0; i<Math.min(input.files.length, 2); i++) {
        var reader=new FileReader();
        reader.onload=function(e) {
            var imagem=document.createElement('img');
            imagem.src=e.target.result;
            imagem.style.maxWidth='100px'; 
            top.appendChild(imagem);
        }
        reader.readAsDataURL(input.files[i]); 
    }
    images.appendChild(top);
    var bottom=document.createElement('div');
    bottom.className='grupo-de-imagens';
    for (var j=2; j<Math.min(input.files.length, 4); j++) {
        var reader=new FileReader();
        reader.onload=function (e) {
            var img=document.createElement('img');
            img.src=e.target.result;
            img.style.maxWidth='100px';
            bottom.appendChild(img);
        }
        reader.readAsDataURL(input.files[j]); 
    }
    images.appendChild(bottom);
    var quadrado=document.querySelector('.quadrado');
    if(quadrado) {
        quadrado.style.display='none';
    }
}
