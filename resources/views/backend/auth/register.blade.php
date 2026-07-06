{{-- resources/views/backend/auth/register.blade.php --}}
@extends('backend.layouts.auth')

@section('title', 'Register')

@section('content')

<p class="login-box-msg">Create a new account</p>

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show mb-3 py-2">
        {{ $errors->first() }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<form method="POST" action="{{ route('register') }}" id="registerForm">
    @csrf

    {{-- Name --}}
    <div class="input-group mb-3">
        <input type="text"
               name="name"
               class="form-control @error('name') is-invalid @enderror"
               placeholder="Full Name"
               value="{{ old('name') }}"
               required autofocus>

        <div class="input-group-text">
            <span class="bi bi-person"></span>
        </div>

        @error('name')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    {{-- Email --}}
    <div class="input-group mb-3">
        <input type="email"
               name="email"
               class="form-control @error('email') is-invalid @enderror"
               placeholder="Email"
               value="{{ old('email') }}"
               required>

        <div class="input-group-text">
            <span class="bi bi-envelope"></span>
        </div>

        @error('email')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    {{-- Password --}}
    <div class="input-group mb-3">
        <input type="password"
               name="password"
               class="form-control @error('password') is-invalid @enderror"
               placeholder="Password"
               required>

        <div class="input-group-text">
            <span class="bi bi-lock"></span>
        </div>

        @error('password')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    {{-- Confirm Password --}}
    <div class="input-group mb-3">
        <input type="password"
               name="password_confirmation"
               class="form-control"
               placeholder="Confirm Password"
               required>

        <div class="input-group-text">
            <span class="bi bi-lock-fill"></span>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="d-grid">
                <button type="submit" class="btn btn-dark" id="submitBtn">
                    <span id="btnText">Register</span>
                    <span id="btnLoading" class="d-none">
                        <span class="spinner-border spinner-border-sm"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
</form>

<p class="mt-3">
    <a href="{{ route('login') }}">Already have an account?</a>
</p>

@endsection

@push('scripts')
<script>
document.getElementById('registerForm').addEventListener('submit', function () {
    document.getElementById('btnText').classList.add('d-none');
    document.getElementById('btnLoading').classList.remove('d-none');
    document.getElementById('submitBtn').disabled = true;
});
</script>
@endpush
