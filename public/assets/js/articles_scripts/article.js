function validateImageFileType(element) {
    var filePath = element.value;
    var allowedExtensions = ['image/jpeg', 'image/png', 'image/jpg', 'image/jfif'];


    const maxFiles = 10;
    const maxSize = 1024 * 1024 * 2; // 2 Mo

    if (element.files.length > maxFiles) {
        element.value = '';
        $.notify({
            icon: 'bi-bell',
            title: 'Pefaco APP',
            message: "Le nombre des fichiers autorisé est dépassé (Seulement 10 éléments)",
        }, {
            type: 'danger',
            placement: {
                from: "bottom",
                align: "right"
            },
            time: 1000,
        });
        return false;
    }else {
        for (const file of element.files) {
            if (!allowedExtensions.includes(file.type)) {
                element.value = '';
                $.notify({
                    icon: 'bi-bell',
                    title: 'Pefaco APP',
                    message: `Le fichier "${file.name}" n'est pas autorisé.`
                }, {
                    type: 'danger',
                    placement: {
                        from: "bottom",
                        align: "right"
                    },
                    time: 1000,
                });
                return;
            }

            if (file.size > maxSize) {
                element.value = '';
                $.notify({
                    icon: 'bi-bell',
                    title: 'Pefaco APP',
                    message: `Le fichier "${file.name}" dépasse la taille autorisée.`,
                }, {
                    type: 'danger',
                    placement: {
                        from: "bottom",
                        align: "right"
                    },
                    time: 1000,
                });
                return false;
            }
        }
    }
}


function validateVideoFileType(element) {
    var filePath = element.value;
    var allowedExtensions = /(\.mp4)$/i;

    if (!allowedExtensions.exec(filePath)) {
        element.value = '';
        $.notify({
            icon: 'bi-bell',
            title: 'Pefaco APP',
            message: "Le type de fichier n'est pas autorisé. ces fichiers sont autorisés: (.mp4)",
        }, {
            type: 'danger',
            placement: {
                from: "bottom",
                align: "right"
            },
            time: 1000,
        });
        return false;
    } else {
        const file = element.files[0];
        const maxSize = (1024 * 1024) * 5; // 5 Mo
        if (file && file.size > maxSize) {
            element.value = '';
            $.notify({
                icon: 'bi-bell',
                title: 'Pefaco APP',
                message: "Le fichier est trop grand. La taille maximale autorisée est de 5 Mo."
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

