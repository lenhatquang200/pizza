@if($images->isNotEmpty())
    <div id="{{ $sliderId }}" class="slick-slider">
        @foreach ($images as $image)
            <div class="carousel-slide">
                <div class="text-overlay-wrapper">
                    @isset($overlayBackground)
                        <div class="overlay-background"></div>
                    @endisset

                    <a href="{{ $image->url ?? '#' }}">
                        <img src="{{ asset('storage/' . $image->imageurl) }}" alt="{{ $altText }}">
                    </a>

                    @if($overlayTextprimary)
                        <div class="text-overlay-container">
                            <div class="text-overlay-primary">{{ $overlayTextprimary }}</div>
                            @if($overlayTextsecondary)
                                <div class="text-overlay-secondary">{{ $overlayTextsecondary }}</div>
                            @endif
                            @isset($buttonUrl)
                              <a href="{{ $image->url ?? '#' }}" class="btn-view-menu">{{ $buttonText ?? 'View Our Menu' }}</a>
                            @endisset
                        </div>
                    @endif

                    @if($customOverlay)
                        <div class="custom-overlay">
                            <p class="custom-text">{{ $customText }}</p>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@else
@include('partials.no-content')
@endif
