const password = document.getElementById("password");
const confirmPassword = document.getElementById("password-confirmation");
const matchPassword = document.getElementById("match");
const form = document.getElementById("formulaire");
const submit_form_btn = document.getElementById("submit_form")
confirmPassword.addEventListener("blur", (event) => {
    const value = event.target.value

    if (value.length && value != password.value) {
        matchPassword.style.display = "unset"
    } else {
        matchPassword.style.display = "none"
    }
})

const updateRequirement = (id, valid) => {
    const requirement = document.getElementById(id);
    if (valid) {
        requirement.classList.add("valid");
    } else {
        requirement.classList.remove("valid");
    }
};

password.addEventListener("input", (event) => {
    const value = event.target.value;
    updateRequirement('length', value.length >= 8)
    updateRequirement('lowercase', /[a-z]/.test(value))
    updateRequirement('uppercase', /[A-Z]/.test(value))
    updateRequirement('number', /\d/.test(value))
    updateRequirement('characters', /[#.?!@$%^&*-]/.test(value))
});

const handleFormValidation = () => {
    const value = password.value;
    const confirmValue = confirmPassword.value;
    if (
        value.length >= 8 &&
        /[a-z]/.test(value) &&
        /[A-Z]/.test(value) &&
        /\d/.test(value) &&
        /[#.?!@$%^&*-]/.test(value) &&
        value == confirmValue
    ) {
        submit_form_btn.removeAttribute("disabled");
        return true;
    }
    submit_form_btn.setAttribute("disabled", true);
    return false;
};

form.addEventListener("change", () => {
    handleFormValidation();
});

function previewImage() {
    const fileInput = document.getElementById('id_photo');
    const imagePreview = document.getElementById('imagePreview');

    const file = fileInput.files[0];
    if (file) {
        const imageUrl = URL.createObjectURL(file);

        // Créez un élément <img> pour afficher la prévisualisation
        imagePreview.src = imageUrl;
    }
}

var fileInput = document.getElementById('id_photo');
fileInput.addEventListener("change", previewImage);

(function () {
    'use strict'
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')
        // Loop over them and prevent submission
        // Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
})()

$(document).ready(function() {
    $('#id_dept').change(function() {
        var id_dept = $(this).val();
        if (id_dept) {
            $.ajax({
                url: '/qualites_loader/' + id_dept,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    $('#id_qualite').empty();
                    $('#id_qualite').append('<option value="">Sélectionner une fonction</option>');
                    $.each(data, function(key, value){
                        $('#id_qualite').append('<option value="' + value.id + '">' + value.designation + '</option>');
                    })
                }, error: function (xhr, status, error){
                    console.log("Erreur: " + error);
                    alert("une erreur est survenue lors du traitement de le requête: "+ error);
                }
            })
        }else {
            $('#id_qualite').empty();
            $('#id_qualite').append('<option value="">Sélectionner une fonction</option>');
        }
    })
})
