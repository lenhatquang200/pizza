document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM fully loaded and parsed');

    const closeButton = document.querySelector('.close--overlay_btn');
    const featuredOverlay = document.querySelector('.featured-overlay');

    // Log the elements to verify they are correctly selected
    console.log('Close Button:', closeButton);
    console.log('Featured Overlay:', featuredOverlay);

    if (!closeButton) {
        console.error('Close button not found!');
        return;
    }

    if (!featuredOverlay) {
        console.error('Featured overlay not found!');
        return;
    }

    closeButton.addEventListener('click', function() {
        console.log('Close button clicked');
        featuredOverlay.style.display = 'none';
    });

    featuredOverlay.addEventListener('click', function(event) {
        if (event.target === this) {
            console.log('Overlay clicked');
            featuredOverlay.style.display = 'none';
        }
    });
});
