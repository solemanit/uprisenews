{{-- resources/views/pages/employee-records/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Employee Records')
@section('page_title', 'Employee Records')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Employee Records</li>
@endsection

@section('content')

    {{-- Toolbar --}}
    <div class="row mb-3 align-items-center">
        <div class="col-md-6">
            <form method="GET" action="{{ route('employee-records.index') }}" class="d-flex gap-2">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input type="text"
                           name="search"
                           value="{{ $search ?? '' }}"
                           class="form-control border-start-0 ps-0"
                           placeholder="Search by name, employee, request no…">
                    @if($search)
                        <a href="{{ route('employee-records.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-x-lg"></i>
                        </a>
                    @endif
                    <button type="submit" class="btn btn-outline-primary">Search</button>
                </div>
            </form>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('employee-records.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-1"></i> Add New Record
            </a>
        </div>
    </div>

    {{-- Table Card --}}
    <div class="card shadow-sm">
        <div class="card-header d-flex align-items-center justify-content-between py-3">
            <h5 class="card-title mb-0">
                <i class="bi bi-person-badge me-2 text-primary"></i>All Employee Records
            </h5>
            <span class="badge bg-primary rounded-pill">{{ $records->total() }}</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th width="50">#</th>
                            <th>Company Name</th>
                            <th>Applicant</th>
                            <th>Date</th>
                            <th width="300" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($records as $record)
                            <tr>
                                <td class="text-muted small">{{ $loop->iteration + ($records->currentPage() - 1) * $records->perPage() }}</td>
                                <td>
                                    <span class="fw-semibold">{{ $record->company_name }}</span>
                                </td>
                                <td>{{ $record->applicant }}</td>
                                <td>{{ $record->date->format('d M Y') }}</td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm" role="group">
                                        {{-- Print --}}
                                        <a href="{{ route('employee-records.print', $record) }}"
                                        class="btn btn-sm btn-dark"
                                        title="Print"
                                        target="_blank">
                                            <i class="bi bi-printer"></i> Print
                                        </a>
                                        <a href="{{ route('employee-records.show', $record) }}"
                                           class="btn btn-info" title="View Details">
                                            <i class="bi bi-eye"></i> View
                                        </a>
                                        <a href="{{ route('employee-records.edit', $record) }}"
                                           class="btn btn-warning" title="Edit">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                        <button type="button"
                                                class="btn btn-danger"
                                                title="Delete"
                                                onclick="confirmDelete({{ $record->id }}, '{{ addslashes($record->employee) }}')">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-5 text-muted">
                                    <i class="bi bi-inbox fs-1 d-block mb-2 opacity-25"></i>
                                    No employee records found.
                                    <a href="{{ route('employee-records.create') }}" class="d-block mt-2">
                                        Create your first record
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if ($records->hasPages())
            <div class="card-footer d-flex justify-content-between align-items-center">
                <small class="text-muted">
                    Showing {{ $records->firstItem() }}–{{ $records->lastItem() }} of {{ $records->total() }} records
                </small>
                {{ $records->links() }}
            </div>
        @endif
    </div>

    {{-- Delete Confirmation Modal --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-danger text-white border-0">
                    <h5 class="modal-title" id="deleteModalLabel">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>Confirm Deletion
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body py-4">
                    <p class="mb-1">Are you sure you want to delete the record for:</p>
                    <p class="fw-bold fs-5 mb-0" id="deleteEmployeeName"></p>
                    <p class="text-muted small mt-2 mb-0">This action cannot be undone.</p>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash me-1"></i> Delete Record
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
function confirmDelete(id, name) {
    document.getElementById('deleteEmployeeName').textContent = name;
    document.getElementById('deleteForm').action = `/employee-records/${id}`;
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}
</script>
@endpush
