document.addEventListener('DOMContentLoaded', function() {
    const loaderContainer = document.getElementById('loader-container');
    const content = document.getElementById('content');

    loaderContainer.style.display = 'block';

    setTimeout(function() {
        loaderContainer.style.display = 'none'; 
        content.style.display = 'block';
    }, 1000);
});
