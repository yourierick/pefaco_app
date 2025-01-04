datedebut = document.getElementById('input_date_debut');
datefin = document.getElementById('input_date_fin');
datefin.addEventListener("input", () => {
    if (!datedebut.value) {
        datefin.value = "";
        $.notify({
            icon: 'bi-bell',
            title: 'Pefaco APP',
            message: "Entrez la première date d'abord",
        }, {
            type: 'danger',
            placement: {
                from: "bottom",
                align: "right"
            },
            time: 1000,
        });
    }else {
        const date1Obj = new Date(datedebut.value);
        const date2Obj = new Date(datefin.value);
        const timeDiff = Math.abs(date2Obj - date1Obj);
        const dayDiff = Math.ceil(timeDiff / (1000 * 60 * 60 * 24));

        if (dayDiff !== 6) {
            $.notify({
                icon: 'bi-bell',
                title: 'Pefaco APP',
                message: 'La différence entre les deux dates doit être de 7 jours.',
            }, {
                type: 'danger',
                placement: {
                    from: "bottom",
                    align: "right"
                },
                time: 1000,
            });
            document.getElementById('input_date_debut').value = '';
            document.getElementById('input_date_fin').value = '';
        }
    }
});
