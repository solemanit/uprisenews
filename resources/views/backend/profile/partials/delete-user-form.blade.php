{{-- Delete User Form --}}
<section class="space-y-6">

    <header class="mb-3">
        <h5 class="mb-1 text-danger">
            Delete Account
        </h5>

        <p class="text-muted small mb-0">
            Once your account is deleted, all data will be permanently removed.
            Please download anything you want to keep first.
        </p>
    </header>

    {{-- Trigger Button --}}
    <button type="button"
            class="btn btn-danger"
            data-bs-toggle="modal"
            data-bs-target="#deleteAccountModal">
        Delete Account
    </button>

    {{-- Modal --}}
    <div class="modal fade"
         id="deleteAccountModal"
         tabindex="-1"
         aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <form method="POST" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('DELETE')

                    <div class="modal-header">
                        <h5 class="modal-title text-danger">
                            Confirm Account Deletion
                        </h5>

                        <button type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <p class="text-muted">
                            This action cannot be undone. Please enter your password to confirm.
                        </p>

                        <div class="mb-3">
                            <label for="delete_password" class="form-label">
                                Password
                            </label>

                            <input type="password"
                                   id="delete_password"
                                   name="password"
                                   class="form-control @error('password', 'userDeletion') is-invalid @enderror"
                                   placeholder="Enter your password"
                                   required>

                            @error('password', 'userDeletion')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button"
                                class="btn btn-secondary"
                                data-bs-dismiss="modal">
                            Cancel
                        </button>

                        <button type="submit" class="btn btn-danger">
                            Delete Account
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

</section>
