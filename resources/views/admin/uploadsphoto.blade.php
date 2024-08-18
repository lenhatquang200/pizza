{{-- @extends('layouts.admin')

@section('title', 'Upload Photos')

@section('admin-content')
    <h2>Upload Photos</h2>
    <form action="{{ route('admin.uploadsphoto.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="photo">Choose a photo:</label>
            <input type="file" name="photo" id="photo" accept="image/*" required>
        </div>
        <button type="submit">Upload</button>
    </form>

    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div>{{ $errors->first() }}</div>
    @endif

    <h3>Uploaded Photos</h3>
    <div class="photo-gallery">
        @forelse($images as $image)
            <div class="photo-item">
                <img src="{{ asset('storage/' . $image->imageurl) }}" alt="Uploaded Photo" style="width: 300px; height: auto;">
                <p>Type: {{ $image->imagetype }}</p>
            </div>
        @empty
            <p>No photos uploaded yet.</p>
        @endforelse
    </div>
@endsection --}}
