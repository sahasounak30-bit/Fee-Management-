function searchCards() {
        const query = document.getElementById('searchInput').value.toLowerCase();
        const cards = document.querySelectorAll('.std-card');
        let visible = 0;

        cards.forEach(card => {
            const name = card.dataset.name || '';
            if (name.includes(query)) {
                card.style.display = '';
                visible++;
            } else {
                card.style.display = 'none';
            }
        });

        document.getElementById('countBadge').textContent = visible + ' student' + (visible !== 1 ? 's' : '');
    }