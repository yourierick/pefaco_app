import './bootstrap';
import DOMPurify from 'dompurify';

import Alpine from 'alpinejs';


document.querySelector('form').addEventListener('submit', (e) => {
    const editorContent = document.querySelector("#editor");
    editorContent.value = DOMPurify.sanitize(editorContent.value);
})
window.Alpine = Alpine;

Alpine.start();
