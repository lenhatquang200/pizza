@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('no-navbar', true)
@section('no-footer', true)

@section('content')
<div class="row">
    <div class="col-lg-2">
        <aside class="admin-sidebar">
            @include('partials.sidebar')
        </aside>
    </div>
    <div class="col-lg-10">
        @include('partials.admin-navbar')
        <main class="admin-content">
            @yield('admin-content')
        </main>
    </div>
</div>
@endsection
