@if(session()->has('featured_shown') === false && $featuredCoupon)
    @php
        session()->put('featured_shown', true);
    @endphp
    <div class="featured-overlay">
        <div class="featured-modal">
            <button class="close--overlay_btn">&times;</button>
            <img src="{{ asset('storage/' . $featuredCoupon->bannerurl) }}" alt="Featured Coupon">
            <a href="{{ $featuredCoupon->url }}" class="btn-view-more">View More</a>
        </div>
    </div>
@endif
