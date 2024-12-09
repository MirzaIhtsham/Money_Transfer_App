@extends('layouts.admin.master')
@section('page_title', 'Dashboard')



@section('specific_title', 'Dashboard')
@section('title', 'Dashboard')
@section('content')
@include('layouts.alerts')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <section>
        <div class="container py-10 px-6">
            @php
                $user = Auth::user(); 
                $country = DB::table('country')->where('id', $user->country_id)->first();
                $User = Auth::user()->usersdocuments->first();
            @endphp

            <div class="row justify-content-center">

                <!-- Profile Card -->
                <div class="col-md-8 col-lg-6 mb-5">
                    <div class="card shadow-lg rounded-lg">
                        <div class="card-body text-center">
                            <div class="d-flex justify-content-center mb-4">
                                <div class="w-24 h-24 rounded-circle overflow-hidden border-4 border-primary">
                                    <img src="{{ "/storage/uploads/profilepics/".$User?->front_side }}" alt="Profile Picture" class="w-100 h-100 object-cover">
                                </div>
                            </div>
                            <h3 class="card-text text-primary font-weight-bold">{{ $user->name }}</h3>
                            <p class="card-text text-muted">{{ $user->email }}</p>
                            <p class="text-sm text-gray-500">Joined: {{ $user->created_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                </div>

                <!-- User Information Cards -->
                <div class="col-md-8 col-lg-6">
                    <div class="row">

                        <!-- Phone -->
                        <div class="col-md-6 mb-4">
                            <div class="card shadow-sm rounded-lg hover:shadow-xl transition duration-300 ease-in-out">
                                <div class="card-body">
                                    <h5 class="card-title text-primary"><i class="fas fa-phone-alt"></i> Phone</h5>
                                    <p class="card-text">{{ $user->phone ?? 'Not provided' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="col-md-6 mb-4">
                            <div class="card shadow-sm rounded-lg hover:shadow-xl transition duration-300 ease-in-out">
                                <div class="card-body">
                                    <h5 class="card-title text-primary"><i class="fas fa-map-marker-alt"></i> Address</h5>
                                    <p class="card-text">{{ $user->address ?? 'Not provided' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Balance -->
                        <div class="col-md-6 mb-4">
                            <div class="card shadow-sm rounded-lg hover:shadow-xl transition duration-300 ease-in-out">
                                <div class="card-body">
                                    <h5 class="card-title text-primary"><i class="fas fa-wallet"></i> Balance</h5>
                                    <p class="card-text">{{ $user->balance ?? 'Not provided' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- CNIC -->
                        <div class="col-md-6 mb-4">
                            <div class="card shadow-sm rounded-lg hover:shadow-xl transition duration-300 ease-in-out">
                                <div class="card-body">
                                    <h5 class="card-title text-primary"><i class="fas fa-id-card"></i> CNIC</h5>
                                    <p class="card-text">{{ $user->id_card_number ?? 'Not provided' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Country -->
                        <div class="col-md-6 mb-4">
                            <div class="card shadow-sm rounded-lg hover:shadow-xl transition duration-300 ease-in-out">
                                <div class="card-body">
                                    <h5 class="card-title text-primary"><i class="fas fa-globe"></i> Country</h5>
                                    <p class="card-text">{{ $country->name ?? 'Not provided' }}</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Edit Profile Button -->
            <div class="text-center mt-6">
                <a href="{{ route('profile.edit') }}" class="btn btn-primary px-6 py-2 rounded-lg shadow-lg hover:bg-blue-700 transition duration-300 ease-in-out transform hover:scale-105">
                    <i class="fas fa-edit mr-2"></i> Edit Profile
                </a>
            </div>
        </div>
    </section>
@endsection
