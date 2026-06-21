{{-- resources/views/backend/auth/login.blade.php --}}
@extends('backend.layouts.auth')

@section('title', 'Sign In')

@section('content')

    <p class="login-box-msg">Sign in to start your session</p>

    {{-- Session status (e.g. after logout) --}}
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show mb-3 py-2" role="alert">
            <i class="bi bi-check-circle me-1"></i> {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Validation errors --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mb-3 py-2" role="alert">
            <i class="bi bi-exclamation-circle me-1"></i> {{ $errors->first() }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form action="{{ route('login') }}" method="POST" id="loginForm">
        @csrf

        {{-- Email --}}
        <div class="input-group mb-3">
            <input
                type="email"
                name="email"
                class="form-control @error('email') is-invalid @enderror"
                placeholder="Email"
                value="{{ old('email') }}"
                required
                autofocus
                autocomplete="username"
                aria-label="Email">
            <div class="input-group-text">
                <span class="bi bi-envelope"></span>
            </div>
            @error('email')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        {{-- Password --}}
        <div class="input-group mb-3">
            <input
                type="password"
                id="password"
                name="password"
                class="form-control @error('password') is-invalid @enderror"
                placeholder="Password"
                required
                autocomplete="current-password"
                aria-label="Password">
            <div class="input-group-text" style="cursor:pointer;" onclick="togglePassword()" title="Show/hide password">
                <span id="pwIcon" class="bi bi-eye"></span>
            </div>
            @error('password')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        {{-- Remember + Submit --}}
        <div class="row">
            <div class="col-8">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
                    <label class="form-check-label" for="remember_me">Remember Me</label>
                </div>
            </div>
            <div class="col-4">
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                        <span id="btnText">Sign In</span>
                        <span id="btnLoading" class="d-none">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        </span>
                    </button>
                </div>
            </div>
        </div>

    </form>

    {{-- Forgot Password --}}
    @if (Route::has('password.request'))
        <p class="mb-1 mt-3">
            <a href="{{ route('password.request') }}">I forgot my password</a>
        </p>
    @endif

@endsection

@push('scripts')
<script>
    function togglePassword() {
        const input = document.getElementById('password');
        const icon  = document.getElementById('pwIcon');
        if (input.type === 'password') {
            input.type     = 'text';
            icon.className = 'bi bi-eye-slash';
        } else {
            input.type     = 'password';
            icon.className = 'bi bi-eye';
        }
    }

    document.getElementById('loginForm').addEventListener('submit', function () {
        document.getElementById('btnText').classList.add('d-none');
        document.getElementById('btnLoading').classList.remove('d-none');
        document.getElementById('submitBtn').disabled = true;
    });
</script>
@endpush
