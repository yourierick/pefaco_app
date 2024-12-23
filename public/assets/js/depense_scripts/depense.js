$(document).ready(function() {
    $('#btn_generate_code').click(function() {
        $.ajax({
            url: 'generate_code',
            type: 'GET',
            dataType: 'json',
            success: function (code) {
                var code_input = document.getElementById('text_code_depense');
                code_input.value = code;
            }, error: function (xhr, status, error){
                $(document).ready(function () {
                    $.notify({
                        icon: 'bi-bell',
                        title: 'Pefaco APP',
                        message: 'une erreur est survenue lors du traitement de le requête',
                    }, {
                        type: 'danger',
                        placement: {
                            from: "bottom",
                            align: "right"
                        },
                        time: 1000,
                    });
                });
            }
        })
    })
})
