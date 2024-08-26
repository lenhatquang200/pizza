document.addEventListener('DOMContentLoaded', () => {
    const hamburgerMenu = document.getElementById('hamburger-menu');
    const sidebar = document.getElementById('sidebarMenu');
    const closeBtn = document.getElementById('closeBtn');

    hamburgerMenu.addEventListener('click', () => {
        sidebar.classList.toggle('show');
    });

    closeBtn.addEventListener('click', () => {
        sidebar.classList.remove('show');
    });

    document.addEventListener('click', (e) => {
        if (!sidebar.contains(e.target) && !hamburgerMenu.contains(e.target) && !closeBtn.contains(e.target)) {
            sidebar.classList.remove('show');
        }
    });
});
