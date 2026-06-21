{{-- resources/views/pages/employee-records/show.blade.php --}}
@extends('layouts.app')

@section('title', $employeeRecord->employee . ' — Record Details')
@section('page_title', 'Record Details')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('employee-records.index') }}">Employee Records</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">{{ $employeeRecord->employee }}</li>
@endsection

@push('styles')
    <style>
        .detail-label {
            font-size: .75rem;
            font-weight: 700;
            letter-spacing: .05em;
            text-transform: uppercase;
            color: var(--bs-secondary-color);
            margin-bottom: .15rem;
        }

        .detail-value {
            font-size: 1rem;
            font-weight: 500;
            color: var(--bs-body-color);
        }

        .detail-value.monospace {
            font-family: var(--bs-font-monospace);
        }

        .section-divider {
            border-top: 2px solid var(--bs-border-color);
            margin: 1.5rem 0;
        }

        .qr-wrapper {
            background: #fff;
            border-radius: 1rem;
            padding: 1rem;
            display: inline-block;
            box-shadow: 0 4px 20px rgba(0, 0, 0, .08);
        }

        @media print {
            .no-print {
                display: none !important;
            }

            .card {
                box-shadow: none !important;
                border: 1px solid #dee2e6 !important;
            }
        }
    </style>
@endpush

@section('content')
    <div class="row">

        {{-- ── Left: Details ─────────────────────────────────────────── --}}
        <div class="col-xl-8">

            {{-- ── Action Toolbar ──────────────────────────────────────── --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <a href="{{ route('employee-records.index') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-arrow-left me-1"></i> Back to List
                </a>
                <div class="d-flex gap-2">
                    <a href="{{ route('employee-records.edit', $employeeRecord) }}" class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil me-1"></i> Edit
                    </a>
                    <a href="{{ route('employee-records.print', $employeeRecord) }}" target="_blank"
                        class="btn btn-primary btn-sm">
                        <i class="bi bi-printer me-1"></i> Print Document
                    </a>
                </div>
            </div>

            {{-- ── Company & Application ──────────────────────────────── --}}
            <div class="card shadow-sm mb-4">
                <div class="card-header py-3 d-flex align-items-center gap-2">
                    <span class="badge bg-primary rounded-circle p-2">
                        <i class="bi bi-building fs-6"></i>
                    </span>
                    <h5 class="card-title mb-0">Company & Application Information</h5>
                </div>
                <div class="card-body pt-3">
                    <div class="row g-4">

                        <div class="col-md-6">
                            <div class="detail-label">Company Name</div>
                            <div class="detail-value">{{ $employeeRecord->company_name }}</div>
                        </div>

                        {{-- ① company_name_ar (NEW) --}}
                        <div class="col-md-6">
                            <div class="detail-label">Company Name (Arabic)</div>
                            <div class="detail-value" dir="rtl">
                                {{ $employeeRecord->company_name_ar ?? '—' }}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="detail-label">Applicant</div>
                            <div class="detail-value">{{ $employeeRecord->applicant ?? '—' }}</div>
                        </div>

                        <div class="col-md-4">
                            <div class="detail-label">Subscriber ID</div>
                            <div class="detail-value monospace">{{ $employeeRecord->subscriber_id ?? '—' }}</div>
                        </div>

                        <div class="col-md-4">
                            <div class="detail-label">Unified Number</div>
                            <div class="detail-value monospace">{{ $employeeRecord->unified_number ?? '—' }}</div>
                        </div>

                        <div class="col-md-4">
                            <div class="detail-label">C.R Number</div>
                            <div class="detail-value monospace">{{ $employeeRecord->cr_number ?? '—' }}</div>
                        </div>

                        <div class="col-md-4">
                            <div class="detail-label">Phone Number</div>
                            <div class="detail-value">
                                <i class="bi bi-telephone me-1 text-muted"></i>{{ $employeeRecord->phone_number ?? '—' }}
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="detail-label">Date</div>
                            <div class="detail-value">
                                <i class="bi bi-calendar3 me-1 text-muted"></i>
                                {{ $employeeRecord->date?->format('d M Y') ?? '—' }}
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="detail-label">Request Number</div>
                            <div class="detail-value monospace text-primary fw-bold">
                                {{ $employeeRecord->request_number ?? '—' }}
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="detail-label">Letter Content</div>
                            <div class="detail-value" style="white-space: pre-line;">
                                {!! nl2br($employeeRecord->letter_content ?? '—') !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Record meta --}}
            <p class="text-muted small no-print">
                <i class="bi bi-clock-history me-1"></i>
                Created {{ $employeeRecord->created_at->diffForHumans() }} &nbsp;|&nbsp;
                Last updated {{ $employeeRecord->updated_at->diffForHumans() }}
            </p>

        </div>

        {{-- ── Right: QR Code ─────────────────────────────────────────── --}}
        <div class="col-xl-4">
            <div class="card shadow-sm sticky-top" style="top: 80px;">
                <div class="card-header py-3 text-center">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-qr-code me-2"></i>QR Code
                    </h5>
                </div>
                <div class="card-body text-center py-4">
                    <div class="qr-wrapper">
                        {!! $qrCode !!}
                    </div>
                    <p class="text-muted small mt-3 mb-2">
                        Scan to view this record's verified details
                    </p>

                    {{-- ── Copyable public link ── --}}
                    <div class="input-group input-group-sm mt-2">
                        <input id="publicLinkInput" type="text" class="form-control font-monospace text-truncate"
                            value="{{ $publicUrl }}" readonly>
                        <button class="btn btn-outline-secondary" type="button" id="copyLinkBtn" title="Copy link"
                            onclick="copyPublicLink()">
                            <i class="bi bi-clipboard" id="copyIcon"></i>
                        </button>
                    </div>

                    {{-- ── Open in new tab ── --}}
                    <a href="{{ $publicUrl }}" target="_blank" class="btn btn-sm btn-outline-primary w-100 mt-2">
                        <i class="bi bi-box-arrow-up-right me-1"></i> Open Public View
                    </a>
                </div>
            </div>

            {{-- Quick Info Badge --}}
            <div class="card shadow-sm mt-3 no-print">
                <div class="card-body">
                    <h6 class="card-title text-muted mb-3">Quick Info</h6>
                    <ul class="list-unstyled mb-0">
                        <li class="d-flex justify-content-between py-1 border-bottom">
                            <span class="text-muted small">Record ID</span>
                            <strong class="small">#{{ $employeeRecord->id }}</strong>
                        </li>
                        <li class="d-flex justify-content-between py-1 border-bottom">
                            <span class="text-muted small">Request No.</span>
                            <strong class="small text-primary">{{ $employeeRecord->request_number ?? '—' }}</strong>
                        </li>
                        <li class="d-flex justify-content-between py-1 border-bottom">
                            <span class="text-muted small">Date</span>
                            <strong class="small">{{ $employeeRecord->date?->format('d M Y') ?? '—' }}</strong>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
    @push('scripts')
        <script>
            function copyPublicLink() {
                const input = document.getElementById('publicLinkInput');
                const icon = document.getElementById('copyIcon');
                const btn = document.getElementById('copyLinkBtn');

                navigator.clipboard.writeText(input.value).then(() => {
                    icon.className = 'bi bi-clipboard-check';
                    btn.classList.replace('btn-outline-secondary', 'btn-success');

                    setTimeout(() => {
                        icon.className = 'bi bi-clipboard';
                        btn.classList.replace('btn-success', 'btn-outline-secondary');
                    }, 2000);
                });
            }
        </script>
    @endpush
@endsection
