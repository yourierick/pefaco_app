document.getElementById('toggleButtonHistorique').addEventListener('click', function() {
    var text = document.getElementById('historique');
    if (text.classList.contains('expanded')) {
        text.classList.remove('expanded');
        this.textContent = 'Voir plus';
    } else {
        text.classList.add('expanded');
        this.textContent = 'voir moins';
    }
});

document.getElementById('toggleButtonMission').addEventListener('click', function() {
    var text = document.getElementById('mission');
    if (text.classList.contains('expanded')) {
        text.classList.remove('expanded');
        this.textContent = 'Voir plus';
    } else {
        text.classList.add('expanded');
        this.textContent = 'voir moins';
    }
});

document.getElementById('toggleButtonVision').addEventListener('click', function() {
    var text = document.getElementById('vision');
    if (text.classList.contains('expanded')) {
        text.classList.remove('expanded');
        this.textContent = 'Voir plus';
    } else {
        text.classList.add('expanded');
        this.textContent = 'voir moins';
    }
});

document.getElementById('toggleButtonCommunaute').addEventListener('click', function() {
    var text = document.getElementById('communaute');
    if (text.classList.contains('expanded')) {
        text.classList.remove('expanded');
        this.textContent = 'Voir plus';
    } else {
        text.classList.add('expanded');
        this.textContent = 'voir moins';
    }
});

document.getElementById('toggleButtonApropos').addEventListener('click', function() {
    var text = document.getElementById('aproposdenous');
    if (text.classList.contains('expanded')) {
        text.classList.remove('expanded');
        this.textContent = 'Voir plus';
    } else {
        text.classList.add('expanded');
        this.textContent = 'voir moins';
    }
});


function expandededparagraph(element) {
    var text = document.getElementById('annonce_description_'+ element.id);
    if (text.classList.contains('expanded')) {
        text.classList.remove('expanded');
        this.textContent = 'Voir plus';
    } else {
        text.classList.add('expanded');
        this.textContent = 'voir moins';
    }
}