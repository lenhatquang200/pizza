@extends('layouts.app')

@section('title', 'Home')

@section('content')
    @component('partials.slider', [
        'images' => $bannerMenuImages,
        'sliderId' => 'menu-image-slider',
        'customOverlay' => false,
        'customText' => '',
        'altText' => 'Menu Image {{ $loop->index + 1 }}',
        'overlayTextprimary' => '🍕 Let Us Cater Your Next Party ! 🍕',
        'overlayTextsecondary' => '',
        'buttonUrl' => '#',
        'buttonText' => 'View Our Menu',
        'noImagesMessage' => 'No menu images found.'
    ])
    @endcomponent

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-12">
                @component('partials.slider', [
                    'images' => $bannerHomeImages,
                    'sliderId' => 'home-image-slider',
                    'customOverlay' => true,
                    'customText' => 'DAILY DEAL',
                    'altText' => 'Home Image {{ $loop->index + 1 }}',
                    'overlayTextprimary' => '10% OFF',
                    'overlayTextsecondary' => 'ANY ORDER',
                    'buttonUrl' => '#',
                    'buttonText' => 'Order Now',
                ])
                @endcomponent
            </div>

            <div class="col-lg-6 col-md-12 coupons-column">
                @if($coupons->isNotEmpty())
                    @component('partials.coupons', [
                        'coupons' => $coupons->take(1),
                        'sliderId' => 'coupons1',
                        'overlayTextprimary' => '$6.99',
                        'overlayTextsecondary' => 'CHOOSE ANY 2 OR MORE',
                        'buttonUrl' => '#',
                        'buttonText' => 'Order Now',
                        'customOverlay' => true,
                        'customText' => 'DAILY DEAL',
                        'noCouponsMessage' => 'No coupons found.'
                    ])
                    @endcomponent
                    @component('partials.coupons', [
                        'coupons' => $coupons->slice(1, 1), // Lấy phần tử thứ hai nếu có
                        'sliderId' => 'coupons2',
                        'overlayTextprimary' => '$6.99',
                        'overlayTextsecondary' => 'CHOOSE ANY 2 OR MORE',
                        'buttonUrl' => '#',
                        'buttonText' => 'Shop Now',
                        'customOverlay' => true,
                        'customText' => 'COMBO DEAL',
                        'noCouponsMessage' => 'No coupons found.'
                    ])
                    @endcomponent
                @else
                @include('partials.no-content')
                @endif
            </div>
        </div>
    </div>
    <!-- Include the featured coupon partial here -->
    @include('partials.featuredcoupon')
@endsection
