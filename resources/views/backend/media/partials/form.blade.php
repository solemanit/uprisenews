{{-- resources/views/backend/media/partials/form.blade.php --}}
@push('scripts')
<script>
$(function () {
    const currentDirectory = @json($directory);
    const uploadModal = new bootstrap.Modal('#uploadModal');

    $('#btnUpload').on('click', () => uploadModal.show());

    $('#btnStartUpload').on('click', function () {
        const files = $('#fileInput')[0].files;
        if (!files.length) return;

        const formData = new FormData();
        [...files].forEach(f => formData.append('files[]', f));
        formData.append('directory', currentDirectory);

        $('#uploadProgress').removeClass('d-none');

        $.ajax({
            url: '{{ route('backend.media.store') }}',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            xhr: function () {
                const xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener('progress', function (e) {
                    if (e.lengthComputable) {
                        const pct = (e.loaded / e.total) * 100;
                        $('#uploadProgress .progress-bar').css('width', pct + '%');
                    }
                });
                return xhr;
            },
            success: function () {
                location.reload();
            },
            error: function (xhr) {
                alert(xhr.responseJSON?.message || 'Upload failed.');
            }
        });
    });

    $('#btnNewFolder').on('click', function () {
        const name = prompt('Folder name:');
        if (!name) return;

        $.ajax({
            url: '{{ route('backend.media.folder.store') }}',
            type: 'POST',
            data: { parent: currentDirectory, name },
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: () => location.reload(),
            error: (xhr) => alert(xhr.responseJSON?.message || 'Failed to create folder.')
        });
    });

    $(document).on('click', '.btn-delete-media', function () {
        if (!confirm('Delete this file?')) return;

        const id = $(this).closest('[data-id]').data('id');
        $.ajax({
            url: `/media/${id}`,
            type: 'DELETE',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: () => location.reload()
        });
    });

    $(document).on('change', '.media-select', function () {
        $('#btnBulkDelete').toggleClass('d-none', $('.media-select:checked').length === 0);
    });

    $('#btnBulkDelete').on('click', function () {
        const ids = $('.media-select:checked').map((_, el) => $(el).val()).get();
        if (!ids.length || !confirm(`Delete ${ids.length} file(s)?`)) return;

        $.ajax({
            url: '{{ route('backend.media.bulk-destroy') }}',
            type: 'DELETE',
            data: { ids },
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: () => location.reload()
        });
    });
});
</script>
@endpush
