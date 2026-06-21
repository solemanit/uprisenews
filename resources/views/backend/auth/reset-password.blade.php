{{-- resources/views/backend/auth/reset-password.blade.php --}}
@extends('backend.layouts.auth')

@section('title', 'Reset Password')

@section('content')

    <p class="login-box-msg">Enter your new password below.</p>

    {{-- Validation errors --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mb-3 py-2" role="alert">
            <i class="bi bi-exclamation-circle me-1"></i> {{ $errors->first() }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form action="{{ route('password.store') }}" method="POST" id="resetForm">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        {{-- Email (readonly) --}}
        <div class="input-group mb-3">
            <input
                type="email"
                name="email"
                class="form-control @error('email') is-invalid @enderror"
                placeholder="Email"
                value="{{ old('email', $request->email) }}"
                required
                readonly
                autocomplete="username"
                aria-label="Email">
            <div class="input-group-text">
                <span class="bi bi-envelope"></span>
            </div>
            @error('email')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        {{-- New Password --}}
        <div class="input-group mb-1">
            <input
                type="password"
                id="password"
                name="password"
                class="form-control @error('password') is-invalid @enderror"
                placeholder="New Password"
                required
                autofocus
                autocomplete="new-password"
                aria-label="New Password">
            <div class="input-group-text" style="cursor:pointer;" onclick="togglePw('password','pwIcon1')" title="Show/hide">
                <span id="pwIcon1" class="bi bi-eye"></span>
            </div>
            @error('password')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        {{-- Strength meter --}}
        <div class="mb-3">
            <div class="progress mt-1" style="height:3px;">
                <div id="strengthBar" class="progress-bar" role="progressbar" style="width:0%;transition:width .3s,background .3s;"></div>
            </div>
            <small id="strengthLabel" class="text-muted" style="font-size:.75rem;"></small>
        </div>

        {{-- Confirm Password --}}
        <div class="input-group mb-3">
            <input
                type="password"
                id="password_confirmation"
                name="password_confirmation"
                class="form-control @error('password_confirmation') is-invalid @enderror"
                placeholder="Confirm Password"
                required
                autocomplete="new-password"
                aria-label="Confirm Password">
            <div class="input-group-text" style="cursor:pointer;" onclick="togglePw('password_confirmation','pwIcon2')" title="Show/hide">
                <span id="pwIcon2" class="bi bi-eye"></span>
            </div>
            @error('password_confirmation')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        {{-- Submit --}}
        <div class="d-grid mb-3">
            <button type="submit" class="btn btn-primary" id="submitBtn">
                <span id="btnText">
                    <i class="bi bi-shield-check me-1"></i> Reset Password
                </span>
                <span id="btnLoading" class="d-none">
                    <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
                    Resetting...
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
    function togglePw(fieldId, iconId) {
        const input = document.getElementById(fieldId);
        const icon  = document.getElementById(iconId);
        input.type  = input.type === 'password' ? 'text' : 'password';
        icon.className = input.type === 'password' ? 'bi bi-eye' : 'bi bi-eye-slash';
    }

    document.getElementById('password').addEventListener('input', function () {
        const v = this.value, bar = document.getElementById('strengthBar'), lbl = document.getElementById('strengthLabel');
        let s = 0;
        if (v.length >= 8)          s++;
        if (/[A-Z]/.test(v))        s++;
        if (/[0-9]/.test(v))        s++;
        if (/[^A-Za-z0-9]/.test(v)) s++;
        const m = [['0%','',''],['25%','#dc3545','Weak'],['50%','#fd7e14','Fair'],['75%','#ffc107','Good'],['100%','#198754','Strong']];
        bar.style.width = m[s][0]; bar.style.backgroundColor = m[s][1];
        lbl.textContent = m[s][2]; lbl.style.color = m[s][1];
    });

    document.getElementById('resetForm').addEventListener('submit', function () {
        document.getElementById('btnText').classList.add('d-none');
        document.getElementById('btnLoading').classList.remove('d-none');
        document.getElementById('submitBtn').disabled = true;
    });
</script>
@endpush
