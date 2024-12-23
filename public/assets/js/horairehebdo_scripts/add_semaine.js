function checkDateDifference() {
    const date1 = document.getElementById('input_date_debut').value;
    const date2 = document.getElementById('input_date_fin').value;

    if (date1 && date2) {
        const date1Obj = new Date(date1);
        const date2Obj = new Date(date2);
        const timeDiff = Math.abs(date2Obj - date1Obj);
        const dayDiff = Math.ceil(timeDiff / (1000 * 60 * 60 * 24));

        if (dayDiff !== 6) {
            alert("La différence entre les deux dates doit être de 7 jours.");
            document.getElementById('input_date_debut').value = '';
            document.getElementById('input_date_fin').value = '';
        }
    }
}
