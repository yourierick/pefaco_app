let message_container = document.getElementById('message_error');
$(document).ready(function() {
    $('#id_type_de_transaction').change(function() {
        let montant_input = document.getElementById('id_montant');
        let type_de_mouvement = $(this).val();
        let btn = document.getElementById("btn_submit");
        if (type_de_mouvement) {
            if (type_de_mouvement === "débit"){
                $('#motif_div').css("display", "unset")
                $('#source_div').css("display", "none")
                $('#id_source').value = "";
                montant_input.value = '';
                montant_input.setAttribute('readonly', 'true');
            }else {
                btn.removeAttribute("disabled");
                $('#source_div').css("display", "unset");
                $('#motif_div').css("display", "none");
                montant_input.value = '';
                montant_input.removeAttribute("readonly");
                let code = document.getElementById('id_code');
                let motif = document.getElementById('id_motif');
                code.value = "";
                motif.value = "";
                message_container.innerHTML = "";
            }
        }
    })
})


$(document).ready(function() {
    let montant_input = document.getElementById('id_montant');
    let btn = document.getElementById("btn_submit");
    let input_depense = document.getElementById('input_departement_depense');
    $('#id_code').blur(function() {
        let code = $(this).val();
        let caisse_id = document.getElementById('caisse_id').value;
        if (code !== ""){
            $.ajax({
                url: '/check_code_de_depense/' + code + '/' + caisse_id,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    if (data === "caisse_error"){
                        btn.setAttribute('disabled', 'true')
                        message_container.innerHTML = "Cette dépense n'est pas prise en charge par cette caisse";
                        montant_input.value = "";
                    }else{
                        if (data.statut){
                            if (data.statut === "validé") {
                                if (data.consommation_depense){
                                    btn.setAttribute('disabled', 'true')
                                    message_container.innerHTML = "Cette dépense a déjà été consommé"
                                    montant_input.value = "";
                                    input_depense.value = "";
                                }else {
                                    btn.removeAttribute("disabled");
                                    montant_input.value = data.montant;
                                    message_container.innerHTML = "";
                                    input_depense.value = data.departement_id;
                                }
                            }else {
                                btn.setAttribute('disabled', 'true')
                                message_container.innerHTML = "Cette dépense n'a pas encore été validé"
                                montant_input.value = "";
                                input_depense.value = "";
                            }
                        }else {
                            btn.setAttribute('disabled', 'true')
                            message_container.innerHTML = "Aucune dépense ne correspond à ce code"
                            montant_input.value = "";
                            input_depense.value = "";
                        }
                    }
                }, error: function (xhr, status, error){
                    console.log("Erreur: " + error);
                    alert("une erreur est survenue lors du traitement de le requête: "+ error);
                }
            })
        }
    })
})
