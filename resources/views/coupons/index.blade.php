@extends('layouts.app')

@section('content')
<div class="container-fluid coupons-container">
    @if($coupons->isNotEmpty())
        <div id="{{ $sliderId }}" class="slick-slider">
            @foreach ($coupons as $coupon)
                <div class="carousel-slide">
                    @if(!empty($coupon->url) && $coupon->url !== '#:' && $coupon->url !== '#')
                        <a href="{{ $coupon->url }}" class="carousel-link">
                            <img src="{{ asset('storage/' . $coupon->bannerurl) }}">
                        </a>
                    @else
                        <a class="carousel-link no-link">
                            <img src="{{ asset('storage/' . $coupon->bannerurl) }}">
                        </a>
                    @endif

                    <a href="#" class="btn-coupon btn-view-menu text-uppercase" data-code="{{ $coupon->couponcode }}">
                        CODE: {{ $coupon->couponcode }}
                        <i class="fa-regular fa-copy"></i>
                    </a>
                </div>
            @endforeach
        </div>
    @else
        @include('partials.no-content')
    @endif
</div>
@endsection
