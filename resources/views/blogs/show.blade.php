@extends('layouts.app')

@section('content')
<div class="container-fluid blog-container">
    <h1 class="h1-custom">{{ $blog->title }}</h1>
    <div class="text-custom">
        @if ($blog->image)
            <img src="{{ Storage::url($blog->image) }}" alt="{{ $blog->title }}" class="blog-image-detail">
        @endif
        <div class="blog-content">
            {!! $blog->content ?? '<p>No content available.</p>' !!}
        </div>
    </div>
    <div class="blog-metadata">
        <p>Published on: {{ $blog->created_at->format('d M Y') }}</p>
    </div>
</div>
@endsection
