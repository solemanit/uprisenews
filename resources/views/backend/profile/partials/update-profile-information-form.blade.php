<section class="card card-primary card-outline">

    <div class="card-header">
        <h5 class="card-title mb-0">Profile Information</h5>
    </div>

    <div class="card-body">

        <p class="text-muted small">
            Update your account profile information and email address.
        </p>

        {{-- Email Verification Form --}}
        <form id="send-verification" method="POST" action="{{ route('verification.send') }}">
            @csrf
        </form>

        {{-- Profile Update Form --}}
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PATCH')

            {{-- Name --}}
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>

                <input type="text"
                       id="name"
                       name="name"
                       class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name', $user->name) }}"
                       required
                       autofocus
                       autocomplete="name">

                @error('name')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Email --}}
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>

                <input type="email"
                       id="email"
                       name="email"
                       class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email', $user->email) }}"
                       required
                       autocomplete="username">

                @error('email')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                @enderror

                {{-- Email Verification Notice --}}
                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())

                    <div class="alert alert-warning mt-3 mb-0">

                        <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">

                            <div>
                                <div class="fw-semibold">
                                    Your email address is unverified.
                                </div>

                                <button form="send-verification"
                                        class="btn btn-link p-0">
                                    Resend verification email
                                </button>
                            </div>

                        </div>

                        @if (session('status') === 'verification-link-sent')
                            <div class="text-success small mt-2">
                                A new verification link has been sent.
                            </div>
                        @endif

                    </div>

                @endif

            </div>

            {{-- Actions --}}
            <div class="d-flex align-items-center gap-3">

                <button type="submit" class="btn btn-primary">
                    Save
                </button>

                @if (session('status') === 'profile-updated')
                    <span class="text-success small" id="profileSavedMsg">
                        Saved.
                    </span>

                    <script>
                        setTimeout(() => {
                            const el = document.getElementById('profileSavedMsg');
                            if (el) el.style.display = 'none';
                        }, 2000);
                    </script>
                @endif

            </div>

        </form>

    </div>
</section>
