@extends('layouts.admin.master')
@section('page_title','profile')
@section('content')

@section('specific_title','profile')
@section('title','prifile')

@include('layouts.alerts')
    <div class="py-12">
        <div class="container-fluid">
            <div class="row g-4 justify-content-center">

                <!-- Left Column (Three Forms) -->
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="card shadow-lg rounded-3 border-0 mb-4">
                        <div class="card-header bg-primary text-white rounded-top">
                            <h5 class="card-title mb-0">{{ __('Update Profile Information') }}</h5>
                        </div>
                        <div class="card-body p-3">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    <div class="card shadow-lg rounded-3 border-0 mb-4">
                        <div class="card-header bg-primary text-white rounded-top">
                            <h5 class="card-title mb-0">{{ __('Update Password') }}</h5>
                        </div>
                        <div class="card-body p-3">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>

                    <div class="card shadow-lg rounded-3 border-0 mb-4">
                        <div class="card-header bg-danger text-white rounded-top">
                            <h5 class="card-title mb-0">{{ __('Delete Account') }}</h5>
                        </div>
                        <div class="card-body p-3">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>

                <!-- Right Column (User Details Form) -->
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="card shadow-lg rounded-3 border-0 mb-4">
                        <div class="card-header bg-primary text-white rounded-top">
                            <h5 class="card-title mb-0">{{ __('Add User Details') }}</h5>
                        </div>
                        <div class="card-body p-3">
                            @include('profile.partials.add-user-details-form')
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
