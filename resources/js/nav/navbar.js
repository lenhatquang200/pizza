$(document).ready(function() {
    const hamburgerMenu = $('#hamburger-menu');
    const sidebar = $('#sidebarMenu');
    const closeBtn = $('#closeBtn');

    hamburgerMenu.on('click', function() {
        sidebar.toggleClass('show');
    });

    closeBtn.on('click', function() {
        sidebar.removeClass('show');
    });

    $(document).on('click', function(e) {
        if (sidebar.hasClass('show')) {
            if (!sidebar.is(e.target) && sidebar.has(e.target).length === 0 &&
                !hamburgerMenu.is(e.target) && hamburgerMenu.has(e.target).length === 0) {
                 e.preventDefault();
                 sidebar.removeClass('show');
            }
        }
    });
    sidebar.on('click', 'a', function(e) {
        // Let links inside the sidebar work normally
        e.stopPropagation(); // Prevents the click event from propagating to the document
    });
});
