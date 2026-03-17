// Highlight changed fields in yellow
const fields = document.querySelectorAll('[data-original]');
fields.forEach(field => {
    const check = () => {
        const changed = field.value !== field.dataset.original;
        field.classList.toggle('changed', changed);
    };
    field.addEventListener('input', check);
    field.addEventListener('change', check);
});