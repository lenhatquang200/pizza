<nav class="navbar_menu">
    <div class="container-fluid">
        <div class="hamburger-menu" id="hamburger-menu">
            <i class="hamburger-icon fas fa-bars"></i>
            <div class="navbar-brand" style="text-align: center;
    flex: auto;" >
                <a href="{{ route('home') }}">
                <img     style="height: 60px;" src="{{ $settings['brand_logo']->image_url ?? asset('storage/default/logo.png') }}">
                </a>
            </div>
        </div>

        <ul class="nav_list ">
            <a class="navbar-brand me-2" href="{{ route('home') }}">
                <img style="height: 60px" src="{{ $settings['brand_logo']->image_url ?? asset('storage/default/logo.png') }}">
            </a>
            <li class="nav_item">
                <a href="{{ route('home') }}" class="nav_link {{ request()->routeIs('home') || request()->is('/') ? 'active' : '' }}">Home</a>
            </li>
            <li class="nav_item">
                <a href="{{ route('menu') }}" class="nav_link {{ request()->routeIs('menu') ? 'active' : '' }}">Menu</a>
            </li>
            <li class="nav_item">
                <a href="{{ route('blogs.index') }}" class="nav_link {{ request()->routeIs('blogs.index') ? 'active' : '' }}">Blog</a>
            </li>
            <li class="nav_item">
                <a href="{{ route('coupons.index') }}" class="nav_link {{ request()->routeIs('coupons.index') ? 'active' : '' }}">Coupon</a>
            </li>
            <li class="nav_item">
                <a href="{{ route('reviews.index') }}" class="nav_link {{ request()->routeIs('reviews.index') ? 'active' : '' }}">Reviews</a>
            </li>
            <li class="nav_item">
                <a href="{{ route('about-us.index') }}" class="nav_link {{ request()->routeIs('about-us.index') ? 'active' : '' }}">About Us</a>
            </li>
            <li class="nav_item">
                <a href="{{ route('contact-us.index') }}" class="nav_link {{ request()->routeIs('contact-us.index') ? 'active' : '' }}">Contact Us</a>
            </li>

            <li class="nav_item"><a href="https://piazzaorsillo.pdqonlineordering.com/Titlepage.aspx" class="nav_link">Order Online</a></li>
            <div class="d-none nav_item d-xl-flex w-auto">
                <i class="fas text-white fa-flip-horizontal fa-2x fa-phone-alt phone-icon"></i>

                <div class="contact-numbers ms-2 text-white">
                    <span>732-805-9506</span>
                    <br>
                    <span>732-805-9507</span>
                </div>
            </div>
        </ul>
    </div>
</nav>
