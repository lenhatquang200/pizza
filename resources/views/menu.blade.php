@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h1 class="h1-custom">Welcome PIAZZA ORSILLO’s Menu</h1>

        @php
            $hasContent = $menus->contains(function ($menu) {
                return !empty($menu['image_path']) || !empty($menu['pdf_url']);
            });
        @endphp

        @if ($hasContent)
            @foreach ($menus as $menu)
                <div class="menu-content">
                    @if (!empty($menu['image_path']))
                        <div class="menu-image-container">
                            <img src="{{ $menu['image_path'] }}" alt="Menu Image" class="img-fluid">
                        </div>
                    @endif

                    @if (!empty($menu['pdf_url']))
                        <div id="pdf-viewer-{{ $loop->index }}" class="menu-pdf-container" data-pdf-url="{{ $menu['pdf_url'] }}"></div>
                    @endif
                </div>
            @endforeach
        @else
        @include('partials.no-content')
        @endif
    </div>
@endsection
