function validateAudioFileType(element) {
    var filePath = element.value;
    var allowedExtensions = /(\.mp3)$/i;

    if (!allowedExtensions.exec(filePath)) {
        element.value = '';
        alert("Le type de fichier n'est pas autorisé. ces fichiers sont autorisés: (.mp3)");
        return false;
    } else {
        const file = element.files[0];
        const maxSize = (1024 * 1024)*50; // 50 Mo
        if (file && file.size > maxSize) {
            element.value = '';
            $.notify({
                icon: 'bi-bell',
                title: 'Pefaco APP',
                message: 'Le fichier est trop grand. La taille maximale autorisée est de 50 Mo, veuillez compresser le fichier.',
            }, {
                type: 'danger',
                placement: {
                    from: "bottom",
                    align: "right"
                },
                time: 1000,
            });
            return false;
        }else{
            return true;
        }
    }
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
        const maxSize = (1024 * 1024)*2; // 2 Mo
        if (file && file.size > maxSize) {
            element.value = '';
            $.notify({
                icon: 'bi-bell',
                title: 'Pefaco APP',
                message: 'Le fichier est trop grand. La taille maximale autorisée est de 2 Mo.',
            }, {
                type: 'danger',
                placement: {
                    from: "bottom",
                    align: "right"
                },
                time: 1000,
            });
            return false;
        }else{
            return true;
        }
    }
}
