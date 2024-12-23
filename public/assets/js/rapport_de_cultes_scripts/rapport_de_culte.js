$(document).ready(function (){
    let count = 1;
    let countoffrande = 1;
    let countautres = 1;
    $('#btn_add_reference').click(function() {
        let input_reference = document.createElement('input');
        let btn_sup = document.createElement('button');
        let divcontainer = document.createElement('div');
        input_reference.setAttribute('name', 'reference[]');
        input_reference.setAttribute('type', 'text');
        input_reference.setAttribute('placeholder', 'Entrez la référence');
        input_reference.setAttribute('class', 'form-control');
        input_reference.required = true;
        //input_reference.style.width = "60%";
        btn_sup.setAttribute('type', 'button');
        btn_sup.setAttribute('class', 'btn');
        btn_sup.style.marginTop = "10px";
        btn_sup.style.color = 'white';
        btn_sup.innerHTML = '<span class="bi-trash-fill text-danger"></span>';

        divcontainer.setAttribute("class", "d-flex mb-0");
        divcontainer.setAttribute('id', 'div_'+count);

        btn_sup.setAttribute('id', 'btn_remove_'+ divcontainer.id);

        divcontainer.style.gap = "5px";
        divcontainer.appendChild(btn_sup);
        divcontainer.appendChild(input_reference);

        let div = document.getElementById('container_reference');
        div.appendChild(divcontainer);

        function deletereference(){
            divcontainer.remove();
        }
        var element = "btn_remove_" + divcontainer.id;
        var btnsup = document.getElementById(element);
        btnsup.addEventListener("click", deletereference);

        count++;
    })
    $('#btn_add_special_offrande').click(function() {
        let input_offrande = document.createElement('input');
        let btn_sup = document.createElement('button');
        let divcontainer = document.createElement('div');
        input_offrande.setAttribute('name', 'don_special[]');
        input_offrande.setAttribute('type', 'text');
        input_offrande.setAttribute('placeholder', "Entrez l'offrande");
        input_offrande.setAttribute('class', 'form-control');
        input_offrande.required = true;
        //input_offrande.style.width = "60%";
        btn_sup.setAttribute('type', 'button');
        btn_sup.setAttribute('class', 'btn');
        btn_sup.style.marginTop = '10px';
        btn_sup.style.color = 'white';
        btn_sup.innerHTML = "<span class='bi-trash-fill text-danger'></span>";

        divcontainer.setAttribute("class", "d-flex mb-0");
        divcontainer.setAttribute('id', 'div_'+countoffrande);

        btn_sup.setAttribute('id', 'btn_remove_'+ divcontainer.id);

        divcontainer.style.gap = "5px";
        divcontainer.appendChild(btn_sup);
        divcontainer.appendChild(input_offrande);

        let div = document.getElementById('container_offrande_speciale');
        div.appendChild(divcontainer);

        function deleteoffrande(){
            divcontainer.remove();
        }
        var element = "btn_remove_" + divcontainer.id;
        var btnsup = document.getElementById(element);
        btnsup.addEventListener("click", deleteoffrande);

        countoffrande++;
    })
    $('#btn_add_autres_faits').click(function() {
        let input_autres_faits = document.createElement('input');
        let btn_sup = document.createElement('button');
        let divcontainer = document.createElement('div');
        input_autres_faits.setAttribute('name', 'autres_faits_a_renseigner[]');
        input_autres_faits.setAttribute('type', 'text');
        input_autres_faits.setAttribute('placeholder', 'Entrez le fait');
        input_autres_faits.setAttribute('class', 'form-control');
        input_autres_faits.required = true;
        //input_autres_faits.style.width = "60%";
        btn_sup.setAttribute('type', 'button');
        btn_sup.setAttribute('class', 'btn');
        btn_sup.style.marginTop = '10px';
        btn_sup.style.color = 'white';
        btn_sup.innerHTML = "<span class='bi-trash-fill text-danger'></span>";

        divcontainer.setAttribute("class", "d-flex mb-0");
        divcontainer.setAttribute('id', 'div_'+countautres);

        btn_sup.setAttribute('id', 'btn_remove_'+ divcontainer.id);

        divcontainer.style.gap = "5px";d
        divcontainer.appendChild(btn_sup);
        divcontainer.appendChild(input_autres_faits);

        let div = document.getElementById('container_autres_faits');
        div.appendChild(divcontainer);

        function deleteautresfaits(){
            divcontainer.remove();
        }
        var element = "btn_remove_" + divcontainer.id;
        var btnsup = document.getElementById(element);
        btnsup.addEventListener("click", deleteautresfaits);

        countautres++;
    })
})


