{{-- resources/views/backend/auth/confirm-password.blade.php --}}
@extends('backend.layouts.auth')

@section('title', 'Confirm Password')

@section('content')

    <p class="login-box-msg">Secure area — please confirm your password to continue.</p>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mb-3 py-2" role="alert">
            <i class="bi bi-exclamation-circle me-1"></i> {{ $errors->first() }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form action="{{ route('password.confirm') }}" method="POST" id="confirmForm">
        @csrf

        <div class="input-group mb-3">
            <input
                type="password"
                id="password"
                name="password"
                class="form-control @error('password') is-invalid @enderror"
                placeholder="Password"
                required
                autofocus
                autocomplete="current-password"
                aria-label="Password">
            <div class="input-group-text" style="cursor:pointer;" onclick="togglePassword()" title="Show/hide">
                <span id="pwIcon" class="bi bi-eye"></span>
            </div>
            @error('password')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-grid mb-3">
            <button type="submit" class="btn btn-dark" id="submitBtn">
                <span id="btnText">
                    <i class="bi bi-shield-lock me-1"></i> Confirm & Continue
                </span>
                <span id="btnLoading" class="d-none">
                    <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
                    Verifying...
                </span>
            </button>
        </div>

    </form>

@endsection

@push('scripts')
<script>
    function togglePassword() {
        const input = document.getElementById('password');
        const icon  = document.getElementById('pwIcon');
        input.type  = input.type === 'password' ? 'text' : 'password';
        icon.className = input.type === 'password' ? 'bi bi-eye' : 'bi bi-eye-slash';
    }

    document.getElementById('confirmForm').addEventListener('submit', function () {
        document.getElementById('btnText').classList.add('d-none');
        document.getElementById('btnLoading').classList.remove('d-none');
        document.getElementById('submitBtn').disabled = true;
    });
</script>
@endpush
