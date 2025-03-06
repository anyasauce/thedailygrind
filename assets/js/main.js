document.addEventListener('DOMContentLoaded', function () {
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content');
    const sidebarCollapseBtn = document.getElementById('sidebarCollapseBtn');
    const toggleSidebar = document.getElementById('toggleSidebar');
    const sidebarOverlay = document.querySelector('.sidebar-overlay');

    // Ensure correct sidebar state on page load
    function checkWidth() {
        if (window.innerWidth < 768) {
            sidebar.classList.remove('open'); // Ensure sidebar is hidden on mobile load
            sidebarOverlay.classList.remove('active'); // Hide overlay
        } else {
            sidebar.classList.add('open'); // Ensure sidebar is open on desktop
            sidebarOverlay.classList.remove('active'); // No overlay on desktop
        }
    }

    // Initial check
    checkWidth();

    // Toggle sidebar (desktop & mobile)
    sidebarCollapseBtn.addEventListener('click', function () {
        sidebar.classList.toggle('open');

        if (window.innerWidth < 768) {
            // Mobile: Toggle overlay
            sidebarOverlay.classList.toggle('active');
        } else {
            // Desktop: Expand content
            content.classList.toggle('expanded');
            sidebar.classList.toggle('collapsed');
            document.querySelector('.brand-text').classList.toggle('d-none');

        }
    });

    toggleSidebar.addEventListener('click', function () {
        sidebar.classList.remove('open');
        sidebarOverlay.classList.remove('active');
    });

    sidebarOverlay.addEventListener('click', function () {
        sidebar.classList.remove('open');
        sidebarOverlay.classList.remove('active');
    });

    window.addEventListener('resize', checkWidth);
});


const darkModeToggle = document.getElementById('darkModeToggle');

if (localStorage.getItem('darkMode') === 'enabled') {
    document.body.classList.add('dark-mode');
    darkModeToggle.checked = true;
}

darkModeToggle.addEventListener('change', function () {
    if (this.checked) {
        document.body.classList.add('dark-mode');
        localStorage.setItem('darkMode', 'enabled');
    } else {
        document.body.classList.remove('dark-mode');
        localStorage.setItem('darkMode', null);
    }
});