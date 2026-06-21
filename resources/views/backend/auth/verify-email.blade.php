{{-- resources/views/backend/auth/verify-email.blade.php --}}
@extends('backend.layouts.auth')

@section('title', 'Verify Email')

@section('content')

    <p class="login-box-msg">
        <i class="bi bi-envelope-paper-fill fs-3 text-primary d-block mb-2"></i>
        Thanks for signing up! Please verify your email address by clicking the link we sent you.
    </p>

    @if (session('status') === 'verification-link-sent')
        <div class="alert alert-success alert-dismissible fade show mb-3 py-2" role="alert">
            <i class="bi bi-check-circle me-1"></i> A new verification link has been sent.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Resend --}}
    <form method="POST" action="{{ route('verification.send') }}" id="resendForm">
        @csrf
        <div class="d-grid mb-3">
            <button type="submit" class="btn btn-primary" id="resendBtn">
                <span id="resendText">
                    <i class="bi bi-arrow-repeat me-1"></i> Resend Verification Email
                </span>
                <span id="resendLoading" class="d-none">
                    <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
                    Sending...
                </span>
            </button>
        </div>
    </form>

    {{-- Logout --}}
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <p class="mb-0 text-center">
            <button type="submit" class="btn btn-link p-0 text-muted" style="font-size:.875rem;">
                <i class="bi bi-box-arrow-left me-1"></i> Log Out
            </button>
        </p>
    </form>

@endsection

@push('scripts')
<script>
    document.getElementById('resendForm').addEventListener('submit', function () {
        document.getElementById('resendText').classList.add('d-none');
        document.getElementById('resendLoading').classList.remove('d-none');
        document.getElementById('resendBtn').disabled = true;
    });
</script>
@endpush
