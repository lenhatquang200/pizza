@if($coupons->isNotEmpty())
    <div id="{{ $sliderId }}" class="slick-slider">
        @foreach ($coupons->take(2) as $coupon)
            <div class="carousel-slide">
                <div class="text-overlay-wrapper">
                    @if($overlayBackground)
                        <div class="overlay-background"></div>
                    @endif
                    <img src="{{ asset('storage/' . $coupon->bannerurl) }}" alt="Coupon Image {{ $loop->index + 1 }}">

                    @if($overlayTextprimary || $overlayTextsecondary || $buttonUrl)
                        <div class="text-overlay-container">
                            @if($overlayTextprimary)
                                <div class="text-overlay-primary">{{ $overlayTextprimary }}</div>
                            @endif
                            @if($overlayTextsecondary)
                                <div class="text-overlay-secondary">{{ $overlayTextsecondary }}</div>
                            @endif
                            @if($buttonUrl)
                                <a href="{{ $buttonUrl }}" class="btn-view-menu">{{ $buttonText }}</a>
                            @endif
                        </div>
                    @endif

                    @if($customOverlay)
                        <div class="custom-overlay">
                            <p class="custom-text">{{ $customText ?? 'Special Offer' }}</p>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@else
    <p>{{ $noCouponsMessage }}</p>
@endif
