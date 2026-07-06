<section class="card card-primary card-outline">

    <div class="card-header">
        <h5 class="card-title mb-0">Update Password</h5>
    </div>

    <div class="card-body">

        <p class="text-muted small">
            Use a long, random password to keep your account secure.
        </p>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            @method('PUT')

            {{-- Current Password --}}
            <div class="mb-3">
                <label for="current_password" class="form-label">
                    Current Password
                </label>

                <input type="password"
                       id="current_password"
                       name="current_password"
                       class="form-control @error('current_password', 'updatePassword') is-invalid @enderror"
                       autocomplete="current-password">

                @error('current_password', 'updatePassword')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- New Password --}}
            <div class="mb-3">
                <label for="password" class="form-label">
                    New Password
                </label>

                <input type="password"
                       id="password"
                       name="password"
                       class="form-control @error('password', 'updatePassword') is-invalid @enderror"
                       autocomplete="new-password">

                @error('password', 'updatePassword')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Confirm Password --}}
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">
                    Confirm Password
                </label>

                <input type="password"
                       id="password_confirmation"
                       name="password_confirmation"
                       class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror"
                       autocomplete="new-password">

                @error('password_confirmation', 'updatePassword')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Actions --}}
            <div class="d-flex align-items-center gap-3">

                <button type="submit" class="btn btn-dark">
                    Save
                </button>

                @if (session('status') === 'password-updated')
                    <span class="text-success small" id="passwordSavedMsg">
                        Saved.
                    </span>

                    <script>
                        setTimeout(() => {
                            const el = document.getElementById('passwordSavedMsg');
                            if (el) el.style.display = 'none';
                        }, 2000);
                    </script>
                @endif

            </div>

        </form>

    </div>
</section>
