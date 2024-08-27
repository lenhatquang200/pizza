 <!-- Sidebar -->
 <div class="navbar_menu_mobile" id="sidebarMenu">
    <div class="close-btn" id="closeBtn">
        <i class="fas fa-times"></i>
    </div>
    <a class="navbar-brand" href="/">
        <img src="{{ $settings['brand_logo']->image_url ?? asset('storage/images/logo.png') }}">
    </a>
    <ul class="nav_list">
        <li class="nav_item"><a href="/" class="nav_link">Home</a></li>
        <li class="nav_item"><a href="/menu" class="nav_link">Menu</a></li>
        <li class="nav_item"><a href="https://piazzaorsillo.pdqonlineordering.com/Titlepage.aspx" class="nav_link">Order Online</a></li>
        <li class="nav_item"><a href="/blogs" class="nav_link">Blogs</a></li>
        <li class="nav_item"><a href="/coupons" class="nav_link">Coupons</a></li>
        <li class="nav_item"><a href="/reviews" class="nav_link">Reviews</a></li>
        <li class="nav_item"><a href="/about-us" class="nav_link">About Us</a></li>
        <li class="nav_item"><a href="/contact-us" class="nav_link">Contact Us</a></li>
    </ul>
</div>
