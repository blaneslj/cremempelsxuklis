// Càlcul en directe de la comanda de samarretes.
// És només informatiu: el servidor torna a calcular els imports en desar.
(() => {
    const comanda = document.getElementById('comanda');
    if (!comanda) return;

    const preu = parseFloat(comanda.dataset.preu);
    const euros = new Intl.NumberFormat('ca-ES', { style: 'currency', currency: 'EUR' });
    const linies = [...comanda.querySelectorAll('.linia-talla')];
    const total = document.getElementById('total');
    const totalUnitats = document.getElementById('total-unitats');

    const quantitatDe = (input) => {
        const q = parseInt(input.value, 10);
        return Number.isInteger(q) && q > 0 ? q : 0;
    };

    const recalcula = () => {
        let suma = 0;
        let unitats = 0;
        for (const linia of linies) {
            const check = linia.querySelector('.js-talla');
            const q = check.checked ? quantitatDe(linia.querySelector('.js-quantitat')) : 0;
            linia.querySelector('.js-import').textContent = euros.format(q * preu);
            suma += q * preu;
            unitats += q;
        }
        total.textContent = euros.format(suma);
        totalUnitats.textContent = unitats;
    };

    for (const linia of linies) {
        const check = linia.querySelector('.js-talla');
        const quantitat = linia.querySelector('.js-quantitat');

        check.addEventListener('change', () => {
            quantitat.disabled = !check.checked;
            if (check.checked) {
                if (!quantitat.value) quantitat.value = 1;
                quantitat.focus();
                quantitat.select();
            } else {
                quantitat.value = '';
                quantitat.classList.remove('is-invalid');
            }
            recalcula();
        });

        quantitat.addEventListener('input', () => {
            quantitat.classList.remove('is-invalid');
            recalcula();
        });
    }

    recalcula();
})();
