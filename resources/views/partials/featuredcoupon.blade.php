@if((session()->has('featured_shown') === false || session()->get('featured_shown')==null) && $featuredCoupon)
    @php
        session()->put('featured_shown', true);
    @endphp
    <div class="featured-overlay">
        <div class="featured-modal">
            <button class="close--overlay_btn">&times;</button>
            <div class="featured-content">
                <div class="featured-text">Get Delicious Savings Now!</div>
                <img src="{{ asset('storage/' . $featuredCoupon->bannerurl) }}">
                <a href="{{ $featuredCoupon->url }}" class="btn-view-more">View More</a>
            </div>
        </div>
    </div>
@endif
