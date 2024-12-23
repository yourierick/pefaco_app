$(document).ready(function (){
    let countprevisionspourcemois = parseInt(document.getElementById('lbl_count_previsions_de_ce_mois').innerHTML) + 1;
    let countrealisationsdecemois = parseInt(document.getElementById('lbl_count_realisations_de_ce_mois').innerHTML) + 1;
    let countprevisionsmoisprochain = parseInt(document.getElementById('lbl_count_previsions_mois_prochain').innerHTML) + 1;
    $('#btn_add_prevision_de_ce_mois').click(function() {
        let textinput = document.createElement('textarea');
        let btn_sup = document.createElement('button');
        let divcontainer = document.createElement('div');
        textinput.setAttribute('name', 'previsions_pour_ce_mois[]');
        textinput.setAttribute('placeholder', 'Renseignez la prévision');
        textinput.setAttribute('class', 'form-control mb-2');
        textinput.setAttribute('rows', "1");
        textinput.required = true;
        btn_sup.setAttribute('type', 'button');
        btn_sup.setAttribute('class', 'btn');
        btn_sup.style.color = 'white';
        btn_sup.innerHTML = "<span class='bi-trash-fill text-danger'></span>";

        divcontainer.setAttribute("class", "d-flex mb-0");
        divcontainer.setAttribute('id', 'div_prevision_'+countprevisionspourcemois);

        btn_sup.setAttribute('id', 'btn_remove_'+ divcontainer.id);

        divcontainer.style.gap = "5px";
        divcontainer.appendChild(btn_sup);
        divcontainer.appendChild(textinput);

        let div = document.getElementById('container_previsions_de_ce_mois');
        div.appendChild(divcontainer);

        function deletePrevisionDeCeMois(){
            divcontainer.remove();
        }
        var element = "btn_remove_" + divcontainer.id;
        var btnsup = document.getElementById(element);
        btnsup.addEventListener("click", deletePrevisionDeCeMois);

        countprevisionspourcemois++;
    })
    $('#btn_add_realisations_pour_ce_mois').click(function() {
        let textinput = document.createElement('textarea');
        let btn_sup = document.createElement('button');
        let divcontainer = document.createElement('div');
        textinput.setAttribute('name', 'realisations_de_ce_mois[]');
        textinput.setAttribute('placeholder', 'Renseignez la réalisation');
        textinput.setAttribute('class', 'form-control mb-2');
        textinput.setAttribute('rows', "1");
        textinput.required = true;
        btn_sup.setAttribute('type', 'button');
        btn_sup.setAttribute('class', 'btn');
        btn_sup.style.color = 'white';
        btn_sup.innerHTML = "<span class='bi-trash-fill text-danger'></span>";

        divcontainer.setAttribute("class", "d-flex mb-0");
        divcontainer.setAttribute('id', 'div_realisation_'+countrealisationsdecemois);

        btn_sup.setAttribute('id', 'btn_remove_'+ divcontainer.id);

        divcontainer.style.gap = "5px";
        divcontainer.appendChild(btn_sup);
        divcontainer.appendChild(textinput);

        let div = document.getElementById('container_realisations_de_ce_mois');
        div.appendChild(divcontainer);

        function deleteRealisationDeCeMois(){
            divcontainer.remove();
        }
        var element = "btn_remove_" + divcontainer.id;
        var btnsup = document.getElementById(element);
        btnsup.addEventListener("click", deleteRealisationDeCeMois);

        countrealisationsdecemois++;
    })
    $('#btn_add_prevision_mois_prochain').click(function() {
        let textinput = document.createElement('textarea');
        let btn_sup = document.createElement('button');
        let divcontainer = document.createElement('div');
        textinput.setAttribute('name', 'previsions_mois_prochain[]');
        textinput.setAttribute('placeholder', 'Renseignez la prévision');
        textinput.setAttribute('class', 'form-control mb-2');
        textinput.setAttribute('rows', "1");
        textinput.required = true;
        btn_sup.setAttribute('type', 'button');
        btn_sup.setAttribute('class', 'btn');
        btn_sup.style.color = 'white';
        btn_sup.innerHTML = "<span class='bi-trash-fill text-danger'></span>";

        divcontainer.setAttribute("class", "d-flex mb-0");
        divcontainer.setAttribute('id', 'div_prevision_mois_prochain_'+countprevisionsmoisprochain);

        btn_sup.setAttribute('id', 'btn_remove_'+ divcontainer.id);

        divcontainer.style.gap = "5px";
        divcontainer.appendChild(btn_sup);
        divcontainer.appendChild(textinput);

        let div = document.getElementById('container_previsions_mois_prochain');
        div.appendChild(divcontainer);

        function deletePrevisionProchainMois(){
            divcontainer.remove();
        }
        var element = "btn_remove_" + divcontainer.id;
        var btnsup = document.getElementById(element);
        btnsup.addEventListener("click", deletePrevisionProchainMois);

        countprevisionsmoisprochain++;
    })
    $("#id_mois").change(function () {
        let departement = document.getElementById("id_dept");
        let id_dept = departement.value;
        let selectedIndex = departement.selectedIndex;
        let nom_du_departement = departement.options[selectedIndex].text;
        let mois = this.value;

        if (nom_du_departement === "comité provincial" || nom_du_departement === "comité des mamans" || nom_du_departement === "comité des jeunes" || nom_du_departement === "ecodim") {
            if (id_dept) {
                $.ajax({
                    url: "../../ajax_requete_load/"+ mois + "/" + id_dept,
                    type: 'GET',
                    dataType: "json",
                    success: function (data) {
                        $('#id_tot_culte').val(data.nombre_total_des_cultes_tenus);
                        $('#id_moyenne_mensuel_total').val(data.moyenne_mensuelle_des_pers_dans_le_culte);
                        $('#id_moyenne_mensuel_hommes').val(data.moyenne_mensuelle_des_hommes);
                        $('#id_moyenne_mensuel_femmes').val(data.moyenne_mensuelle_des_mamans);
                        $('#id_moyenne_mensuel_jeunes').val(data.moyenne_mensuelle_des_jeunes);
                        $('#id_moyenne_mensuel_enfants').val(data.moyenne_mensuelle_des_enfants);
                        $('#id_situation_caisse').val(data.solde_caisse);
                    }, error: function (xhr, status, error) {
                        console.log(error);
                    }
                })
            }
        }
    })
})

function deleteprevisionpourcemois(button){
    const parent = button.parentNode;
    parent.remove();
}

function deleterealisationspourcemois(button){
    const parent = button.parentNode;
    parent.remove();
}

function deleteprevisionsmoisprochain(button){
    const parent = button.parentNode;
    parent.remove();
}


