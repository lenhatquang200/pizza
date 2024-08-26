<div class="container">
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="/">
            <img src="{{ $settings['brand_logo']->image_url ?? asset('storage/images/logo.png') }}" alt="Logo">
        </a>
        <div class="navbar-collapse">
            <div class="navbar-info">
                <div class="order-info">
                    <a href="https://piazzaorsillo.pdqonlineordering.com/Titlepage.aspx" class="btn btn-order-now">
                        <i class="fas fa-phone-alt phone-icon"></i> Order Now
                    </a>
                    <div class="contact-numbers">
                        <span>732-805-9506</span>
                        <span>732-805-9507</span>
                    </div>
                </div>
                <div class="address-info">
                    <a href="/contact-us" class="btn btn-address">
                        <i class="fas fa-map-marker-alt address-icon"></i> Address
                    </a>
                    <p class="address-details">
                        120 Cedar Grove Ln, Cedar Grove Center Somerset, NJ 08873
                    </p>
                </div>
            </div>
        </div>
    </nav>
</div>
