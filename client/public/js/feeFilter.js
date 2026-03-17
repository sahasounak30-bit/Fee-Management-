let activeStatus = 'all';

    function filterTable() {
        const search = document.getElementById('searchInput').value.toLowerCase();
        const rows   = document.querySelectorAll('#feeTable tbody tr');
        let visible  = 0;

        rows.forEach(row => {
            const name   = row.dataset.name  || '';
            const phone  = row.dataset.phone || '';
            const status = row.dataset.status;

            const matchSearch = name.includes(search) || phone.includes(search);
            const matchStatus = activeStatus === 'all' || status === activeStatus;

            if (matchSearch && matchStatus) {
                row.style.display = '';
                visible++;
            } else {
                row.style.display = 'none';
            }
        });

        document.getElementById('rowCount').textContent = visible + ' records';
    }

    function filterChip(el, status) {
        document.querySelectorAll('.chip').forEach(c => c.classList.remove('active'));
        el.classList.add('active');
        activeStatus = status;
        filterTable();
    }