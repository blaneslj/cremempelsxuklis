// Web pública: botó «Comparteix» i menú del mòbil
(() => {
    // Comparteix: menú natiu del mòbil si n'hi ha; si no, copia l'enllaç
    for (const boto of document.querySelectorAll('.js-comparteix')) {
        const avis = boto.parentElement.querySelector('.xk-comparteix-avis');
        boto.addEventListener('click', async () => {
            const dades = { title: boto.dataset.titol, text: boto.dataset.text, url: boto.dataset.url };
            if (navigator.share) {
                try { await navigator.share(dades); } catch (e) { /* cancel·lat */ }
                return;
            }
            try {
                await navigator.clipboard.writeText(`${dades.text} ${dades.url}`);
                if (avis) avis.textContent = 'Enllaç copiat! Enganxa’l on vulguis.';
            } catch (e) {
                if (avis) avis.textContent = `Copia aquest enllaç: ${dades.url}`;
            }
        });
    }

    // En triar una secció des del menú plegat, tanca'l
    const menu = document.getElementById('menu');
    if (menu && window.bootstrap) {
        menu.addEventListener('click', (e) => {
            if (e.target.closest('a') && menu.classList.contains('show')) {
                bootstrap.Collapse.getOrCreateInstance(menu).hide();
            }
        });
    }
})();
