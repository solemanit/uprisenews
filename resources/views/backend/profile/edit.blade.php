@extends('backend.layouts.app')

@section('title', 'Profile')

@section('page_title', 'Profile')

@section('breadcrumb')
    <li class="breadcrumb-item active">Profile</li>
@endsection

@section('content')

<div class="container-fluid">

    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="d-flex flex-column gap-4">

                {{-- Profile Information --}}
                <div>
                    @include('backend.profile.partials.update-profile-information-form')
                </div>

                {{-- Update Password --}}
                <div>
                    @include('backend.profile.partials.update-password-form')
                </div>

                {{-- Delete Account --}}
                {{-- <div>
                    @include('backend.profile.partials.delete-user-form')
                </div> --}}

            </div>

        </div>
    </div>

</div>

@endsection
