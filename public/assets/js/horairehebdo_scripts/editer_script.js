$(document).ready(function (){
    let count = parseInt(document.getElementById('lbl_count').innerHTML) + 1;
    $('#btn_programme').click(function() {
        let textarea = document.createElement('textarea');
        let btn_sup = document.createElement('button');
        let divcontainer = document.createElement('div');
        textarea.setAttribute('name', 'programme[]');
        textarea.setAttribute('placeholder', 'Entrez le programme');
        textarea.setAttribute('class', 'form-control mb-2');
        textarea.required = true;
        textarea.style.width = "80%";
        btn_sup.setAttribute('type', 'button');
        btn_sup.setAttribute('class', 'btn btn-danger');
        btn_sup.style.height = '80%';
        btn_sup.style.color = 'white';
        btn_sup.innerHTML = "supprimer";

        divcontainer.setAttribute("class", "d-flex");
        divcontainer.setAttribute('id', 'div_'+count);

        btn_sup.setAttribute('id', 'btn_remove_programme_'+ divcontainer.id);

        divcontainer.style.gap = "5px";
        divcontainer.appendChild(textarea);
        divcontainer.appendChild(btn_sup);

        let div = document.getElementById('container');
        div.appendChild(divcontainer);

        function deleteprogramme(){
            divcontainer.remove();
        }
        var element = "btn_remove_programme_" + divcontainer.id;
        var btnsup = document.getElementById(element);
        btnsup.addEventListener("click", deleteprogramme);

        count++;
    })
})


function deleteexistprogramme(button){
    const parent = button.parentNode;
    parent.remove();
}
