<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Piazza Orsillo')</title>
    <link rel="icon" href="{{ $settings['brand_logo']->image_url ?? asset('storage/images/logo.png') }}" type="image/png">
    <x-head.tinymce-config/>

    <!-- CSS & Scripts -->
    @vite(['resources/css/app.scss', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</head>
<body>
    <!-- Loader -->
    <div id="loader-container" class="loader-container">
        @include('partials.loader')
    </div>

    <!-- Content -->
    <div id="content-container">
        <div id="content">
            <!-- Navbar -->
            @include('partials.navbar')
            @include('partials.sidebar')

            <div class="container-fluid">
                <div class="container">
                    @if (!Route::is('blogs.show'))
                        @include('partials.navbar_menu')
                    @endif
                    @yield('content')
                </div>
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
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
