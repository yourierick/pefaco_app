$(document).ready(function() {
    $('#id_departement').change(function() {
        var id_dept = $(this).val();
        if (id_dept) {
            $.ajax({
                url: '/load_users/' + id_dept,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    $('#id_caissier').empty();
                    $('#id_caissier').append('<option value="" selected disabled>---------------</option>');
                    $.each(data, function(key, value){
                        $('#id_caissier').append('<option value="' + value.id + '">' + value.nom + ' ' + value.postnom + ' ' + value.prenom + '</option>');
                    })
                }, error: function (xhr, status, error){
                    console.log("Erreur: " + error);
                    alert("une erreur est survenue lors du traitement de le requête: "+ error);
                }
            })
        }else {
            $('#id_caissier').empty();
            $('#id_caissier').append('<option value="" selected disabled>---------------</option>');
        }
    })
})
