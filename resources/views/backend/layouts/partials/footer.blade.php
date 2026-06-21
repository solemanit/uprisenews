{{-- resources/views/layouts/backend/partials/footer.blade.php --}}
<footer class="app-footer">
    <div class="float-end d-none d-sm-inline">
        <strong>v{{ config('app.version', '1.0.0') }}</strong>
    </div>
    <strong>
        Copyright &copy; {{ date('Y') }}&nbsp;
        <a href="{{ config('app.url') }}" class="text-decoration-none">
            {{ config('app.name') }}
        </a>.
    </strong>
    All rights reserved.
</footer>
