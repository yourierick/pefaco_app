function validateImageFileType(element) {
    var filePath = element.value;
    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.jfif)$/i;

    if (!allowedExtensions.exec(filePath)) {
        element.value = '';
        alert("Le type de fichier n'est pas autorisé. ces fichiers sont autorisés: (.jpg, .jpeg, .png, .jfif)");
        return false;
    } else {
        const file = element.files[0];
        const maxSize = (1024 * 1024)*5; // 5 Mo
        if (file && file.size > maxSize) {
            element.value = '';
            alert('Le fichier est trop grand. La taille maximale autorisée est de 5 Mo.');
            return false;
        }else{
            return true;
        }
    }
}
