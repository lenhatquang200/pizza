@extends('layouts.app')

@section('content')
<div class="container-fluid blog-container">
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
                                <img src="{{ Storage::url($blog->image) }}" alt="{{ $blog->title }}" class="blog-image">
                            @endif
                        </div>
                        <div class="col-lg-10 col-md-8 blog-content-container">
                            <a href="{{ route('blogs.show', $blog->slug) }}">
                                <h2 class="blog-title">{{ $blog->title }}</h2>
                            </a>
                            <p class="blog-date">Published on: {{ $blog->created_at->format('M d Y') }}</p>
                            <p class="blog-description">{{ $blog->short_description }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
@endsection
