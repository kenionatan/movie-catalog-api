@extends('layouts.app')

@section('content')

<div class="movie-header">
    <div class="header-logo header-item">
        Home
    </div>
    <div class="header-menu header-item">
        <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#registerModal">
            Register
        </button>
    </div>
</div>

<div class="movie-content">
    
</div>

<!-- Register Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <form id="register_user" action="">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="registerModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Kenio N">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Register</button>
            </div>
        </form>
    </div>
  </div>
</div>

@endsection

@push('scripts')
    <script src="{{ url(mix('js/index.js')) }}"></script>
@endpush