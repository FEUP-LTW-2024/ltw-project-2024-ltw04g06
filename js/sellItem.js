function showImage(input) {
    if (input.files && input.files[0]) {
        var read=new FileReader();
        read.onload=function(e) {
            document.getElementById('quadrado').style.display='none'; 
            document.getElementById('imagemExibida').style.display='block'; 
            document.getElementById('imagemExibida').src=e.target.result; 
        }
        read.readAsDataURL(input.files[0]); 
    }
}
