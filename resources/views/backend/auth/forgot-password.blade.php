{{-- resources/views/backend/auth/forgot-password.blade.php --}}
@extends('backend.layouts.auth')

@section('title', 'Forgot Password')

@section('content')

    <p class="login-box-msg">Forgot your password? Enter your email to reset it.</p>

    {{-- Success status --}}
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show mb-3 py-2" role="alert">
            <i class="bi bi-envelope-check me-1"></i> {{ session('status') }}
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

    <form action="{{ route('password.email') }}" method="POST" id="forgotForm">
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

        {{-- Submit --}}
        <div class="d-grid mb-3">
            <button type="submit" class="btn btn-dark" id="submitBtn">
                <span id="btnText">
                    <i class="bi bi-send me-1"></i> Send Reset Link
                </span>
                <span id="btnLoading" class="d-none">
                    <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
                    Sending...
                </span>
            </button>
        </div>

    </form>

    <p class="mb-0">
        <a href="{{ route('login') }}">
            <i class="bi bi-arrow-left me-1"></i> Back to Sign In
        </a>
    </p>

@endsection

@push('scripts')
<script>
    document.getElementById('forgotForm').addEventListener('submit', function () {
        document.getElementById('btnText').classList.add('d-none');
        document.getElementById('btnLoading').classList.remove('d-none');
        document.getElementById('submitBtn').disabled = true;
    });
</script>
@endpush
