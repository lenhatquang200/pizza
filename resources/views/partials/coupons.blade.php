@if($coupons->isNotEmpty())
    <div id="{{ $sliderId }}" class="slick-slider">
        @foreach ($coupons as $coupon)
            <div class="carousel-slide">
                <div class="text-overlay-wrapper">
                    @if(!empty($coupon->url) && $coupon->url !== '#:' && $coupon->url !== '#')
                        <a href="{{ $coupon->url }}" class="carousel-link">
                            <img src="{{ asset('storage/' . $coupon->bannerurl) }}" alt="Coupon Image {{ $loop->index + 1 }}">
                        </a>
                    @else
                        <a class="carousel-link no-link">
                            <img src="{{ asset('storage/' . $coupon->bannerurl) }}" alt="Coupon Image {{ $loop->index + 1 }}">
                        </a>
                    @endif

                    @if($overlayTextprimary || $overlayTextsecondary || $buttonUrl)
                        <div class="text-overlay-container">
                            @if($overlayTextprimary)
                                <div class="text-overlay-primary">{{ $overlayTextprimary }}</div>
                            @endif
                            @if($overlayTextsecondary)
                                <div class="text-overlay-secondary">{{ $overlayTextsecondary }}</div>
                            @endif
                            <a href="#" class="btn-coupon btn-view-menu text-uppercase" data-code="{{ $coupon->couponcode  }}">
                                CODE: {{ $coupon->couponcode  }}
                                <i class="fa-regular fa-copy"></i>
                            </a>
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
    @include('partials.no-content')
@endif
