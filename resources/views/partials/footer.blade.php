<div class="container">
    <footer class="footer footer-expand-lg">
        <div class="footer-content">
            <div class="footer-brand">
                <a class="brand" href="/">
                    <img src="{{ $settings['brand_logo']->image_url ?? asset('storage/images/logo.png') }}" alt="Logo">
                </a>
                <div class="social-icons">
                    @if(isset($settings['facebook_url']) && $settings['facebook_url']->value)
                        <a href="{{ $settings['facebook_url']->value }}" class="social-icon facebook_url">
                            <i class="fab fa-facebook"></i>
                        </a>
                    @endif
                    @if(isset($settings['twitter_url']) && $settings['twitter_url']->value)
                        <a href="{{ $settings['twitter_url']->value }}" class="social-icon twitter_url">
                            <i class="fab fa-twitter"></i>
                        </a>
                    @endif
                    @if(isset($settings['instagram_url']) && $settings['instagram_url']->value)
                        <a href="{{ $settings['instagram_url']->value }}" class="social-icon instagram_url">
                            <i class="fab fa-instagram"></i>
                        </a>
                    @endif
                </div>
            </div>

            <div class="footer-links">
                <div class="quick-links">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="/">Home</a></li>
                        <li><a href="/coupons">Coupons</a></li>
                        <li><a href="/blogs">Blogs</a></li>
                    </ul>
                </div>

                <div class="customer-service">
                    <h4>Customer Service</h4>
                    <ul>
                        <li><a href="/about-us">About Us</a></li>
                        <li><a href="https://piazzaorsillo.pdqonlineordering.com/Titlepage.aspx">Order Online</a></li>
                        <li><a href="/contact-us">Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <div class="footer-bottom">
        <p>&copy; {{ date('Y') }} Piazza Orsillo. All Rights Reserved.</p>
    </div>
</div>
