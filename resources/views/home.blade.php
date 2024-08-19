@extends('layouts.app')

@section('title', 'Home')

@section('content')
    @component('partials.slider', [
        'images' => $bannerMenuImages,
        'sliderId' => 'menu-image-slider',
        'overlayBackground' => true,
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
            <!-- Slider Column -->
            <div class="col-lg-6 col-md-12">
                @component('partials.slider', [
                    'images' => $bannerHomeImages,
                    'sliderId' => 'home-image-slider',
                    'customOverlay' => true,
                    'customText' => 'DAILI DEAL',
                    'altText' => 'Home Image {{ $loop->index + 1 }}',
                    'overlayTextprimary' => '10% OFF',
                    'overlayTextsecondary' => 'ANY ORDER',
                    'buttonUrl' => '#',
                    'buttonText' => 'Order Now',
                    'buttonText' => 'Order Now',
                ])
                @endcomponent
            </div>

            <div class="col-lg-6 col-md-12 coupons-column">
                @component('partials.coupons', [
                    'coupons' => collect([$coupon1]),
                    'sliderId' => 'coupons1',
                    'overlayBackground' => true,
                    'overlayTextprimary' => '$6.99',
                    'overlayTextsecondary' => 'CHOOSE ANY 2 OR MORE',
                    'buttonUrl' => '#',
                    'buttonText' => 'Order Now',
                    'customOverlay' => true,
                    'customText' => 'DAILI DEAL',
                    'noCouponsMessage' => 'No coupons found.'
                ])
                @endcomponent
                @component('partials.coupons', [
                    'coupons' => collect([$coupon2]),
                    'sliderId' => 'coupons2',
                    'overlayBackground' => true,
                    'overlayTextprimary' => '$6.99',
                    'overlayTextsecondary' => 'CHOOSE ANY 2 OR MORE',
                    'buttonUrl' => '#',
                    'buttonText' => 'Shop Now',
                    'customOverlay' => true,
                    'customText' => 'COMBO DEAL',
                    'noCouponsMessage' => 'No coupons found.'
                ])
                @endcomponent
            </div>
        </div>
    </div>
@endsection
