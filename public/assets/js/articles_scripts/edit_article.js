$(document).ready(function (){
    let count = parseInt(document.getElementById('lbl_count').innerHTML) + 1;
    $('#btn_add_photo').click(function() {
        let input_photo = document.createElement('input');
        let btn_sup = document.createElement('button');
        let divcontainer = document.createElement('div');
        let icon = document.createElement('i');
        icon.setAttribute('class', 'bx bxs-trash');
        input_photo.setAttribute('name', 'bibliotheque[]');
        input_photo.setAttribute('type', 'file');
        input_photo.setAttribute('class', 'form-control mb-2');
        input_photo.setAttribute('accept', '.jpeg, .jpg, .png, .jfif');
        input_photo.setAttribute('onchange', 'validateImageFileType(this)');
        input_photo.required = true;
        input_photo.style.width = "60%";
        btn_sup.setAttribute('type', 'button');
        btn_sup.setAttribute('class', 'btn btn-danger');
        btn_sup.style.height = '80%';
        btn_sup.style.color = 'white';

        divcontainer.setAttribute("class", "d-flex");
        divcontainer.setAttribute('id', 'div_'+count);

        btn_sup.setAttribute('id', 'btn_remove_photo_'+ divcontainer.id);
        btn_sup.appendChild(icon)

        divcontainer.style.gap = "5px";
        divcontainer.appendChild(btn_sup);
        divcontainer.appendChild(input_photo);

        let div = document.getElementById('galerie_photo');
        div.appendChild(divcontainer);

        function deletephoto(){
            divcontainer.remove();
        }
        var element = "btn_remove_photo_" + divcontainer.id;
        var btnsup = document.getElementById(element);
        btnsup.addEventListener("click", deletephoto);

        count++;
    })
})

function deletephoto(button){
    const parent = button.parentNode;
    parent.remove();
}


function validateImageFileType(element) {
    var filePath = element.value;
    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.jfif)$/i;

    if (!allowedExtensions.exec(filePath)) {
        element.value = '';
        alert("Le type de fichier n'est pas autorisé. ces fichiers sont autorisés: (.jpg, .jpeg, .png, .jfif)");
        return false;
    } else {
        const file = element.files[0];
        const maxSize = 1 * 1024 * 1024; // 1 Mo
        if (file && file.size > maxSize) {
            element.value = '';
            alert('Le fichier est trop grand. La taille maximale autorisée est de 1 Mo.');
            return false;
        }else{
            return true;
        }
    }
}


function validateVideoFileType(element) {
    var filePath = element.value;
    var allowedExtensions = /(\.mp4)$/i;

    if (!allowedExtensions.exec(filePath)) {
        element.value = '';
        alert("Le type de fichier n'est pas autorisé. ces fichiers sont autorisés: (.mp4)");
        return false;
    } else {
        const file = element.files[0];
        const maxSize = (1024 * 1024) * 5; // 5 Mo
        if (file && file.size > maxSize) {
            element.value = '';
            alert('Le fichier est trop grand. La taille maximale autorisée est de 5 Mo.');
            return false;
        }else{
            return true;
        }
    }
}


