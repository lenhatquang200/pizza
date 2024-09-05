@extends('layouts.app')

@section('title', 'Home - Piazza Orisillo')

@section('content')
    @component('partials.slider', [
        'images' => $bannerMenuImages,
        'sliderId' => 'menu-image-slider',
        'customOverlay' => false,
        'customText' => '',
        'altText' => 'Menu Image {{ $loop->index + 1 }}',
        'overlayTextprimary' => ' ',
        'overlayTextsecondary' => '',
        'buttonUrl' => '#',
        'buttonText' => 'VIEW OUR MENU',
        'noImagesMessage' => 'No menu images found.'
    ])
    @endcomponent

    <div class="container-home" style="text-align: -webkit-center;">
        <div class="row">
            <div class="col-lg-6 col-md-12">
                @component('partials.slider', [
                    'images' => $bannerHomeImages,
                    'sliderId' => 'home-image-slider',
                    'customOverlay' => false,
                    'customText' => ' ',
                    'altText' => 'Home Image {{ $loop->index + 1 }}',
                    'overlayTextprimary' => ' ',
                    'overlayTextsecondary' => ' ',
                    'buttonUrl' => '#',
                    'buttonText' => 'ORDER NOW',
                ])
                @endcomponent
            </div>

            <div class="col-lg-6 col-md-12 coupons-column">
                @if($coupons->isNotEmpty())
                    @component('partials.coupons', [
                        'coupons' => $coupons->take(1),
                        'sliderId' => 'coupons1',
                        'overlayTextprimary' => '',
                        'overlayTextsecondary' => '',
                        'buttonUrl' => '#',
                        'buttonText' => 'ORDER NOW',
                        'customOverlay' => false,
                        'customText' => '',
                        'noCouponsMessage' => ''
                    ])
                    @endcomponent
                    @component('partials.coupons', [
                        'coupons' => $coupons->slice(1, 1),
                        'sliderId' => 'coupons2',
                        'overlayTextprimary' => ' ',
                        'overlayTextsecondary' => ' ',
                        'buttonUrl' => '#',
                        'buttonText' => 'ORDER NOW',
                        'customOverlay' => false,
                        'customText' => '',
                        'noCouponsMessage' => ''
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
