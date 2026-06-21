{{-- resources/views/backend/dashboard.blade.php --}}
@extends('backend.layouts.app')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        Hello, welcome to your dashboard!
    </div>
</div>
@endsection

@push('scripts')
    {{-- Page-specific JS goes here --}}
@endpush
