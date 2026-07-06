{{-- resources/views/backend/media/index.blade.php --}}
@extends('backend.layouts.app')

@section('title', 'Media Library')
@section('page_title', 'Media Library')
@section('breadcrumb')
    <li class="breadcrumb-item active">Media Library</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-2">
            <button type="button" class="btn btn-sm btn-dark" id="btnUpload">
                <i class="bi bi-upload"></i> Upload
            </button>
            <button type="button" class="btn btn-sm btn-outline-secondary" id="btnNewFolder">
                <i class="bi bi-folder-plus"></i> New Folder
            </button>
            <button type="button" class="btn btn-sm btn-outline-danger d-none" id="btnBulkDelete">
                <i class="bi bi-trash"></i> Delete Selected
            </button>
        </div>
        <form class="d-flex" method="GET">
            <input type="hidden" name="directory" value="{{ $directory }}">
            <input type="search" name="q" value="{{ request('q') }}" class="form-control form-control-sm" placeholder="Search files...">
        </form>
    </div>

    <div class="card-body">
        {{-- Breadcrumb path --}}
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('backend.media.index') }}">Root</a></li>
                @if($directory !== '/')
                    <li class="breadcrumb-item active">{{ $directory }}</li>
                @endif
            </ol>
        </nav>

        {{-- Folders --}}
        @if(count($folders))
        <div class="row mb-3">
            @foreach($folders as $folder)
            <div class="col-6 col-sm-3 col-md-2 mb-3">
                <a href="{{ route('backend.media.index', ['directory' => $folder]) }}"
                   class="text-decoration-none text-body d-block text-center p-3 border rounded folder-item">
                    <i class="bi bi-folder-fill fs-1 text-warning"></i>
                    <div class="small text-truncate mt-1">{{ basename($folder) }}</div>
                </a>
            </div>
            @endforeach
        </div>
        @endif

        {{-- Files Grid --}}
        <div class="row" id="mediaGrid">
            @forelse($media as $item)
            <div class="col-6 col-sm-3 col-md-2 mb-3" data-id="{{ $item->id }}">
                <div class="border rounded position-relative media-item">
                    <input type="checkbox" class="form-check-input media-select position-absolute top-0 start-0 m-2" value="{{ $item->id }}">
                    <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1 btn-delete-media" title="Delete">
                        <i class="bi bi-x"></i>
                    </button>
                    @if(str_starts_with($item->mime_type, 'image/'))
                        <img src="{{ $item->thumb_url }}" alt="{{ $item->alt_text }}" class="w-100" style="height:120px;object-fit:cover;">
                    @else
                        <div class="d-flex align-items-center justify-content-center bg-light" style="height:120px;">
                            <i class="bi bi-file-earmark-text fs-1 text-secondary"></i>
                        </div>
                    @endif
                    <div class="p-1 small text-truncate" title="{{ $item->original_name }}">
                        {{ $item->original_name }}
                    </div>
                    <div class="p-1 small text-muted">{{ $item->human_size }}</div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center text-muted py-5">No files in this folder.</div>
            @endforelse
        </div>

        {{ $media->links() }}
    </div>
</div>

{{-- Upload Modal --}}
<div class="modal fade" id="uploadModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload Files</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="file" id="fileInput" class="form-control" multiple
                       accept="image/*,.pdf,.doc,.docx,.mp4">
                <div class="progress mt-3 d-none" id="uploadProgress">
                    <div class="progress-bar" style="width:0%"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" id="btnStartUpload">Upload</button>
            </div>
        </div>
    </div>
</div>

@include('backend.media.partials.form')
@endsection
