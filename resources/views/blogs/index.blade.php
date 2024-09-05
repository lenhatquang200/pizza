@extends('layouts.app')

@section('content')
<div class="bg-white">
    <h1 class="h1-custom">Blogs List</h1>
    <div class="row blog-list">
        @if ($blogs->isEmpty())
        @include('partials.no-content')
        @else
            @foreach ($blogs as $blog)
                <div class="col-lg-12 col-md-12 col-sm-12 blog-item">
                    <div class="row no-gutters">
                        <div class="col-lg-2 col-md-4 blog-image-container">
                            @if ($blog->image)
                                <a href="{{ route('blogs.show', $blog->slug) }}">
                                    <img src="{{ Storage::url($blog->image) }}" alt="{{ $blog->title }}" class="blog-image">
                                </a>
                            @endif
                        </div>
                        <div class="col-lg-10 col-md-8 blog-content-container">
                            <a href="{{ route('blogs.show', $blog->slug) }}">
                                <h4 class="blog-title">{{ $blog->title }}</h4>
                            </a>
                            <p class="blog-date"><i>{{ $blog->created_at->format('M, d Y') }}</i></p>
                            <p class="blog-description">{{ $blog->short_description }}</p>
                        </div>
                    </div>
                </div>
                <hr>
            @endforeach
        @endif
    </div>
</div>
@endsection
