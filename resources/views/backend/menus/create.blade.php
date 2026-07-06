@extends('backend.layouts.app')

@section('title', 'Create Menu')

@section('content')
<div class="card card-primary card-outline">
    <div class="card-header">
        <h3 class="card-title">Create Menu</h3>
    </div>

    <form action="{{ route('backend.menus.store') }}" method="POST">
        @csrf
        <div class="card-body">

            <div class="mb-3">
                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                    class="form-control @error('name') is-invalid @enderror" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" name="slug" id="slug" value="{{ old('slug') }}"
                    class="form-control @error('slug') is-invalid @enderror"
                    placeholder="Auto-generated from name if left blank">
                @error('slug')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="location" class="form-label">Location <span class="text-danger">*</span></label>
                <select name="location" id="location"
                    class="form-select @error('location') is-invalid @enderror" required>
                    <option value="">Select location</option>
                    @foreach (['header' => 'Header Menu', 'footer' => 'Footer Menu', 'mobile' => 'Mobile Menu'] as $value => $label)
                        <option value="{{ $value }}" @selected(old('location') === $value)>{{ $label }}</option>
                    @endforeach
                </select>
                @error('location')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="form-text">Each location can only have one menu assigned.</div>
            </div>

            <div class="form-check form-switch">
                <input type="checkbox" name="is_active" id="is_active" value="1"
                    class="form-check-input" @checked(old('is_active', true))>
                <label for="is_active" class="form-check-label">Active</label>
            </div>

        </div>

        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('backend.menus.index') }}" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-circle"></i> Create & Add Items
            </button>
        </div>
    </form>
</div>
@endsection
