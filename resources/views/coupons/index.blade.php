@extends('layouts.app')

@section('content')
<div class="container-fluid coupons-container">
    @if($coupons->isNotEmpty())
        <div id="{{ $sliderId }}" class="slick-slider">
            @foreach ($coupons as $coupon)
                <div class="carousel-slide">
                    <a href="{{ $coupon->url }}" class="carousel-link">
                        <img src="{{ asset('storage/' . $coupon->bannerurl) }}" alt="Coupon Image {{ $loop->index + 1 }}">
                    </a>

                    <a href="{{ $coupon->url }}" class="btn-view-menu">View More</a>
                </div>
            @endforeach
        </div>
    @else
    @include('partials.no-content')
    @endif
</div>
@endsection
