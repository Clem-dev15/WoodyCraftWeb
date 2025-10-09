document.addEventListener('DOMContentLoaded', function() {
    const paiementRadios = document.querySelectorAll('input[name="paiement"]');
    const formCarte = document.getElementById('form-carte');

    function toggleFormCarte() {
        const paiementSelectionne = document.querySelector('input[name="paiement"]:checked').value;
        if (paiementSelectionne === 'carte') {
            formCarte.style.display = 'block';
            formCarte.querySelectorAll('input').forEach(input => input.required = true);
        } else {
            formCarte.style.display = 'none';
            formCarte.querySelectorAll('input').forEach(input => input.required = false);
        }
    }

    toggleFormCarte();

    paiementRadios.forEach(radio => {
        radio.addEventListener('change', toggleFormCarte);
    });
});
