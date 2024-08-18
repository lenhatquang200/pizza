document.addEventListener('DOMContentLoaded', function () {
    const toggleButton = document.getElementById('sidebarToggle');
    const closeButton = document.getElementById('closeSidebar');
    const sidebar = document.getElementById('adminSidebar');

    if (toggleButton && sidebar) {
        toggleButton.addEventListener('click', function () {
            sidebar.classList.toggle('show');
        });
    }

    if (closeButton && sidebar) {
        closeButton.addEventListener('click', function () {
            sidebar.classList.remove('show');
        });
    }
});
