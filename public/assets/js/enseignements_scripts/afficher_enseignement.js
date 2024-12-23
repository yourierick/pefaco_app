document.getElementById('toggleButton').addEventListener('click', function() {
    var text = document.getElementById('text');
    if (text.classList.contains('expanded')) {
        text.classList.remove('expanded');
        this.textContent = 'Voir plus';
    } else {
        text.classList.add('expanded');
        this.textContent = 'voir moins';
    }
});
