// resources\js\global\site.js

document.addEventListener('DOMContentLoaded', function () {
    console.log('hieu dep trai'); // Thêm thông báo này
    if (window.$) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });
    } else {
        console.warn('jQuery is not loaded.');
    }
});

