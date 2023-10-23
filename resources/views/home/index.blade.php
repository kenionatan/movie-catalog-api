@extends('layouts.app')

@section('content')

<div class="movie-header">
    <div class="header-logo header-item">
        Home
    </div>
    <div class="header-menu header-item">
        <a href="" type="button" class="btn btn-light">Register</a>
    </div>
</div>

<div class="movie-content">
    
</div>

@endsection

@push('scripts')
    <script src="{{ url(mix('js/index.js')) }}"></script>
@endpush