function handleCheckboxClick(checkbox) {
    const childCheckboxes = document.querySelectorAll('.child_ecriture_chkbox.' + checkbox.id);
    if (checkbox.checked) {
        childCheckboxes.forEach(function(box) {
            box.checked = checkbox.checked;
            box.removeAttribute('disabled');
        });
    } else {
        childCheckboxes.forEach(function(box) {
            box.checked = checkbox.checked;
            box.setAttribute('disabled', true);
        });
    }
}
