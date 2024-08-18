document.addEventListener('DOMContentLoaded', function () {
    const toggleButton = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('adminNavbarNav');

    if (toggleButton && sidebar) {
        toggleButton.addEventListener('click', function () {
            // Check if the sidebar is currently hidden
            const isExpanded = sidebar.classList.contains('show');

            // Toggle classes based on current state
            sidebar.classList.toggle('d-none', isExpanded);
            sidebar.classList.toggle('show', !isExpanded);

            // Update aria-expanded attribute
            toggleButton.setAttribute('aria-expanded', !isExpanded ? 'true' : 'false');
        });
    }
});
