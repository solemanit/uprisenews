{{-- resources/views/pages/employee-records/edit.blade.php --}}
@extends('layouts.app')

@section('title', 'Edit Employee Record')
@section('page_title', 'Edit Employee Record')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('employee-records.index') }}">Employee Records</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('employee-records.show', $employeeRecord) }}">{{ $employeeRecord->employee }}</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">Edit</li>
@endsection

@push('styles')
    <style>
        .translate-badge {
            position: absolute;
            right: .6rem;
            top: 50%;
            transform: translateY(-50%);
            font-size: .72rem;
            opacity: 0;
            transition: opacity .2s;
            pointer-events: none;
        }
        .translate-badge.visible { opacity: 1; }
        .translatable-wrap { position: relative; }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs5.min.css">
@endpush

@section('content')
    <div class="row justify-content-center">
        <div class="col-xl-10">
            <form action="{{ route('employee-records.update', $employeeRecord) }}" method="POST"
                id="recordForm" novalidate>
                @csrf
                @method('PUT')

                {{-- ── Company & Application Info ─────────────────── --}}
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white py-3">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-building me-2"></i>Company & Application Information
                        </h5>
                    </div>
                    <div class="card-body pt-4">
                        <div class="row g-3">

                            {{-- Company Name (EN) --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold" for="company_name">
                                    Company Name
                                </label>
                                <div class="translatable-wrap">
                                    <input type="text" id="company_name" name="company_name"
                                        class="form-control pe-5 @error('company_name') is-invalid @enderror"
                                        value="{{ old('company_name', $employeeRecord->company_name) }}"
                                        autocomplete="off"
                                        data-translate-target="company_name_ar">
                                    <span class="translate-badge badge bg-secondary" id="badge_company_name">
                                        <span class="spinner-border spinner-border-sm me-1"></span>Translating…
                                    </span>
                                </div>
                                @error('company_name')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Company Name (AR) --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold" for="company_name_ar">
                                    Company Name (Arabic)
                                    <span class="badge bg-info text-dark ms-1" style="font-size:.7rem;">Auto-translated</span>
                                </label>
                                <input type="text" id="company_name_ar" name="company_name_ar"
                                    class="form-control" dir="rtl"
                                    value="{{ old('company_name_ar', $employeeRecord->company_name_ar) }}"
                                    placeholder="Company Name (Arabic)" readonly>
                            </div>

                            {{-- Applicant (EN) --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold" for="applicant">
                                    Applicant
                                </label>
                                <div class="translatable-wrap">
                                    <input type="text" id="applicant" name="applicant"
                                        class="form-control pe-5 @error('applicant') is-invalid @enderror"
                                        value="{{ old('applicant', $employeeRecord->applicant) }}"
                                        autocomplete="off"
                                        data-translate-target="applicant_ar">
                                    <span class="translate-badge badge bg-secondary" id="badge_applicant">
                                        <span class="spinner-border spinner-border-sm me-1"></span>Translating…
                                    </span>
                                </div>
                                @error('applicant')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Applicant (AR) --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold" for="applicant_ar">
                                    Applicant (Arabic)
                                    <span class="badge bg-info text-dark ms-1" style="font-size:.7rem;">Auto-translated</span>
                                </label>
                                <input type="text" id="applicant_ar" name="applicant_ar"
                                    class="form-control" dir="rtl"
                                    value="{{ old('applicant_ar', $employeeRecord->applicant_ar) }}"
                                    placeholder="Applicant name in Arabic" readonly>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold" for="subscriber_id">Subscriber ID</label>
                                <input type="text" id="subscriber_id" name="subscriber_id"
                                    class="form-control @error('subscriber_id') is-invalid @enderror"
                                    value="{{ old('subscriber_id', $employeeRecord->subscriber_id) }}">
                                @error('subscriber_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold" for="unified_number">Unified Number</label>
                                <input type="text" id="unified_number" name="unified_number"
                                    class="form-control @error('unified_number') is-invalid @enderror"
                                    value="{{ old('unified_number', $employeeRecord->unified_number) }}">
                                @error('unified_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold" for="cr_number">C.R Number</label>
                                <input type="text" id="cr_number" name="cr_number"
                                    class="form-control @error('cr_number') is-invalid @enderror"
                                    value="{{ old('cr_number', $employeeRecord->cr_number) }}">
                                @error('cr_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold" for="phone_number">Phone Number</label>
                                <input type="text" id="phone_number" name="phone_number"
                                    class="form-control @error('phone_number') is-invalid @enderror"
                                    value="{{ old('phone_number', $employeeRecord->phone_number) }}">
                                @error('phone_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold" for="date">Date</label>
                                <input type="date" id="date" name="date"
                                    class="form-control @error('date') is-invalid @enderror"
                                    value="{{ old('date', $employeeRecord->date->format('Y-m-d')) }}">
                                @error('date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold" for="request_number">Request Number</label>
                                <input type="text" id="request_number" name="request_number"
                                    class="form-control @error('request_number') is-invalid @enderror"
                                    value="{{ old('request_number', $employeeRecord->request_number) }}">
                                @error('request_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold" for="employee">Employee</label>
                                <input type="text" id="employee" name="employee"
                                    class="form-control @error('employee') is-invalid @enderror"
                                    value="{{ old('employee', $employeeRecord->employee) }}">
                                @error('employee')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label class="form-label fw-semibold" for="letter_content">Letter Content</label>
                                <textarea id="editor" name="letter_content" rows="3"
                                    class="form-control @error('letter_content') is-invalid @enderror" placeholder="Letter content">{{ old('letter_content', $employeeRecord->letter_content) }}</textarea>
                                @error('letter_content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>


                {{-- ── Actions ──────────────────────────────────────── --}}
                <div class="d-flex justify-content-end gap-2 mb-4">
                    <a href="{{ route('employee-records.show', $employeeRecord) }}" class="btn btn-secondary">
                        <i class="bi bi-x-lg me-1"></i> Cancel
                    </a>
                    <button type="submit" class="btn btn-dark px-4">
                        <i class="bi bi-save me-1"></i> Update Record
                    </button>
                </div>

            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
$(function () {
    // ── Generic EN → AR Translator ────────────────────────────────
    async function translateToArabic(text, targetEl, badgeEl) {
        if (!text.trim()) { targetEl.value = ''; return; }
        if (badgeEl) badgeEl.classList.add('visible');
        try {
            const url  = `https://api.mymemory.translated.net/get?q=${encodeURIComponent(text)}&langpair=en|ar`;
            const res  = await fetch(url);
            const data = await res.json();
            if (data.responseStatus === 200) {
                targetEl.value = data.responseData.translatedText;
            }
        } catch {
            targetEl.value = '';
        } finally {
            if (badgeEl) badgeEl.classList.remove('visible');
        }
    }

    // ── Bind all translatable fields ─────────────────────────────
    // Each input with data-translate-target="<ar_field_id>" is auto-wired
    const timers = {};

    document.querySelectorAll('[data-translate-target]').forEach(function (sourceEl) {
        const targetId = sourceEl.dataset.translateTarget;
        const targetEl = document.getElementById(targetId);
        const badgeEl  = document.getElementById('badge_' + sourceEl.id);

        if (!targetEl) return;

        sourceEl.addEventListener('input', function () {
            clearTimeout(timers[sourceEl.id]);
            timers[sourceEl.id] = setTimeout(
                () => translateToArabic(this.value, targetEl, badgeEl),
                600
            );
        });

        // Trigger on load if existing value present
        if (sourceEl.value) translateToArabic(sourceEl.value, targetEl, badgeEl);
    });

});
</script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs5.min.js"></script>
<script src="{{ asset('assets/editor/editor.js') }}"></script>
@endpush
