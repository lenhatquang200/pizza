$(document).ready(function() {
    const hamburgerMenu = $('#hamburger-menu');
    const sidebar = $('#sidebarMenu');
    const closeBtn = $('#closeBtn');

    // Toggle sidebar when hamburger menu is clicked
    hamburgerMenu.on('click', function() {
        sidebar.toggleClass('show');
    });

    // Close sidebar when close button is clicked
    closeBtn.on('click', function() {
        sidebar.removeClass('show');
    });

    // Click handling for closing sidebar or following links inside
    $(document).on('click', function(e) {

        // If the sidebar is open
        if (sidebar.hasClass('show')) {
            // Check if click is outside sidebar and hamburger menu
            if (!sidebar.is(e.target) && sidebar.has(e.target).length === 0 &&
                !hamburgerMenu.is(e.target) && hamburgerMenu.has(e.target).length === 0) {

                // Prevent link follow if clicked outside the sidebar
                    e.preventDefault();

                // Close the sidebar if the click is outside
                sidebar.removeClass('show');
            }
        }
    });

    // Allow sidebar links to work normally
    sidebar.on('click', 'a', function(e) {
        // Let links inside the sidebar work normally
        e.stopPropagation(); // Prevents the click event from propagating to the document
    });
});
