// ── Search
function searchRows() {
    const q = document.getElementById('searchInput').value.toLowerCase();
    const rows = document.querySelectorAll('#stdTable tbody tr');
    let visible = 0;
    rows.forEach(row => {
        const match = (row.dataset.name || '').includes(q) || (row.dataset.phone || '').includes(q);
        row.style.display = match ? '' : 'none';
        if (match) visible++;
    });
    document.getElementById('countBadge').textContent = visible + ' student' + (visible !== 1 ? 's' : '');
}

// ── View Modal
function openModal(s) {
    document.getElementById('m-name').textContent = s.first_name + ' ' + s.last_name;
    document.getElementById('m-phone').textContent = s.phone;
    document.getElementById('m-dob').textContent = s.dob;
    document.getElementById('m-gender').textContent = s.gender.charAt(0).toUpperCase() + s.gender.slice(1);
    document.getElementById('m-edu').textContent = s.edu_qualification;
    document.getElementById('m-address').textContent = s.address || '—';
    document.getElementById('m-admission').textContent = s.admition_date;
    document.getElementById('viewModal').classList.add('open');
}
function closeModal() {
    document.getElementById('viewModal').classList.remove('open');
}

// ── Confirm Delete
function openConfirm(id, name) {
    document.getElementById('deleteId').value = id;
    document.getElementById('confirmText').textContent =
        'This will permanently remove "' + name + '" and all their fee records.';
    document.getElementById('confirmOverlay').classList.add('open');
}
function closeConfirm() {
    document.getElementById('confirmOverlay').classList.remove('open');
}

// Close modals on overlay click
document.getElementById('viewModal').addEventListener('click', function (e) {
    if (e.target === this) closeModal();
});
document.getElementById('confirmOverlay').addEventListener('click', function (e) {
    if (e.target === this) closeConfirm();
});