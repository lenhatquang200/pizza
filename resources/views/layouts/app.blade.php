<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Piazza Orsillo')</title>
    <link rel="icon" href="{{ asset('storage/default/favicon.png') }}" type="image/png">
    <!-- CSS & Scripts -->
    @vite(['resources/css/app.scss', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</head>
<body>
    <!-- Loader -->
    @include('partials.loader')

    <!-- Content -->
    <div id="content-container">
        <div id="content ">
            <!-- Navbar -->
            @include('partials.navbar_menu')

            @include('partials.sidebar')

            <div class="container">
{{--                    @if (!Route::is('blogs.show'))--}}
{{--                    @endif--}}
                    @yield('content')
            </div>

            @if(!View::hasSection('no-footer'))
                @include('partials.footer')
            @endif
        </div>
    </div>

    <!-- Optionally include Bootstrap JS and dependencies -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.btn-coupon').on('click', function(event) {
                event.preventDefault();

                var couponCode = $(this).data('code');
                var $tempInput = $('<input>');
                $('body').append($tempInput);
                $tempInput.val(couponCode).select();
                document.execCommand('copy');
                $tempInput.remove();
                toastr.success('Copied!')
                // alert('Coupon code copied to clipboard: ' + couponCode);
            });
        });

    </script>
@stack('scripts')
</body>
</html>
