$(document).ready(function () {
    let count = 1;
    $('#btn_add_bibliotheque').click(function () {
        let input_file = document.createElement('input');
        let btn_sup = document.createElement('button');
        let divcontainer = document.createElement('div');
        input_file.setAttribute('name', 'bibliotheque[]');
        input_file.setAttribute('type', 'file');
        input_file.setAttribute('class', 'form-control mb-2');
        input_file.setAttribute('onchange', 'validateImageFileType(this)');
        input_file.setAttribute('accept', '.jpeg, .png, .jpg, .jfif');
        input_file.required = true;
        input_file.style.width = "60%";
        btn_sup.setAttribute('type', 'button');
        btn_sup.setAttribute('class', 'btn btn-danger');
        btn_sup.style.height = '80%';
        btn_sup.style.color = 'white';
        btn_sup.innerHTML = "supprimer";

        divcontainer.setAttribute("class", "d-flex");
        divcontainer.setAttribute('id', 'div_' + count);

        btn_sup.setAttribute('id', 'btn_remove_' + divcontainer.id);

        divcontainer.style.gap = "5px";
        divcontainer.appendChild(input_file);
        divcontainer.appendChild(btn_sup);

        let div = document.getElementById('bibliotheque');
        div.appendChild(divcontainer);

        function deleteinput() {
            divcontainer.remove();
        }

        var element = "btn_remove_" + divcontainer.id;
        var btnsup = document.getElementById(element);
        btnsup.addEventListener("click", deleteinput);

        count++;
    })
})


function validateImageFileType(element) {
    var filePath = element.value;
    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.jfif)$/i;

    if (!allowedExtensions.exec(filePath)) {
        element.value = '';
        alert("Le type de fichier n'est pas autorisé. ces fichiers sont autorisés: (.jpg, .jpeg, .png, .jfif)");
        return false;
    } else {
        const file = element.files[0];
        const maxSize = 1024 * 1024; // 1 Mo
        if (file && file.size > maxSize) {
            element.value = '';
            alert('Le fichier est trop grand. La taille maximale autorisée est de 1 Mo.');
            return false;
        }else{
            return true;
        }
    }
}


function avalidateVideoFileType(element) {
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

