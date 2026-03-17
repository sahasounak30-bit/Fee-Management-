// Live clock
    function updateClock() {
        const now = new Date();
        document.getElementById('clock').textContent =
            now.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
        document.getElementById('date-display').textContent =
            now.toLocaleDateString('en-US', { weekday: 'short', day: 'numeric', month: 'short', year: 'numeric' });
    }
    updateClock();
    setInterval(updateClock, 1000);

    // Keyboard shortcuts
    document.addEventListener('keydown', e => {
        if (e.target.tagName === 'INPUT') return;
        if (e.key === 's' || e.key === 'S') location.href = '/feeManager/client/views/page/studentFetch.php';
        if (e.key === 'f' || e.key === 'F') location.href = '/feeManager/client/views/page/feePage.php';
        if (e.key === 'c' || e.key === 'C') location.href = '/feeManager/client/views/page/studentCreate.php';
    });