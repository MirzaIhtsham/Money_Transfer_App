{{-- <x-app-layout>
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">   
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        <div class="max-w-xl">

<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <form method="post" action="{{ route('currency.update', $currency->id) }}"  class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('post')


        

        <div>
            <x-input-label for="currency" :value="__('Currency Name:')" />
            <x-text-input id="currency" name="currency_name" type="text" class="mt-1 block w-full" :value="old('currency_name', $currency->name)"  : required autofocus autocomplete="currency_name" />
            <x-input-error :messages="$errors->get('currency_name')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="code" :value="__('Currency Code:')" />
            <x-text-input id="code" name="currency_code" type="text" class="mt-1 block w-full" :value="old('currency_code', $currency->code)" : required autofocus autocomplete="currency_code" />
            <x-input-error :messages="$errors->get('currency_code')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="currency" :value="__('Country:')" />
            <select id="currency" name="country_id" class="mt-1 block w-full bg-transparent" :required autofocus autocomplete="currency_name">
                <option value="@php
                    echo $currency->country_id;
                @endphp" :value="old('country_id', $currency->country_id) == ''" :selected="old('country_id', $currency->country_id) == ''">@php echo $currency->country->name; @endphp</option>
                @foreach ($countries as $currency)
                    <option value="{{ $currency->id }}" :selected="old('country_id', $currency->country_id) == $currency->id " >{{ $currency->name }}</option>
                @endforeach
                
                
            </select>
            <x-input-error :messages="$errors->get('country_id')" class="mt-2" />
        </div>
       

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Update') }}</x-primary-button>
            <a href="{{ route('currencies.index') }}" class="px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white rounded">Back to Currency List</a>

           
        </div>
    </form>
</div>
        </div>

</div>





</x-app-layout> --}}




@extends('layouts.admin.master')
@section('page_title', 'Edit Currency')

@push('css')
<!-- Google Fonts -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
<!-- Bootstrap 4 -->
<link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}">
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
@endpush



@section('specific_title', 'Edit Currency')
@section('title', 'Edit Currency')
@section('content')
<!-- Main content section -->
<section class="content">
<div class="container-fluid">
    <div class="row">
        <!-- Card for form layout -->
        <div class="col-12">
            <div class="card card-primary" style="border-radius: 12px; padding: 20px;">
                <div class="card-header bg-primary text-white text-center d-flex justify-content-between">
                    <h3 class="card-title"> <i class="fas fa-edit"></i>Edit Currency</h3>

                    <a href="{{ route('currencies.index') }}" class="btn btn-secondary btn-md ml-auto">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>

                <!-- Form start -->
                <form action="{{ route('currency.update', $currency->id) }}" method="POST">
                    @csrf
                    @method('post')
                    <div class="card-body">
                        <!-- Currency Name Field -->
                        <div class="form-group">
                            <label for="currency_name">Currency Name:</label>
                            <input id="currency_name" name="currency_name" type="text" class="form-control @error('currency_name') is-invalid @enderror" placeholder="Enter the name of the currency" value="{{ old('currency_name', $currency->name) }}" required>
                            @error('currency_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Currency Code Field -->
                        <div class="form-group">
                            <label for="currency_code">Currency Code:</label>
                            <input id="currency_code" name="currency_code" type="text" class="form-control @error('currency_code') is-invalid @enderror" placeholder="Enter the currency code" value="{{ old('currency_code', $currency->code) }}" required>
                            @error('currency_code')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Country Dropdown -->
                        <div class="form-group">
                            <label for="country_id">Country:</label>
                            <select id="country_id" name="country_id" class="form-control select2 @error('country_id') is-invalid @enderror" style="width: 100%;" required>
                                <option value="" disabled selected>Select a country</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}" {{ old('country_id', $currency->country_id) == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                                @endforeach
                            </select>
                            @error('country_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <!-- Card footer with submit and back buttons -->
                    <div class="card-footer ">
                        <button type="submit" class="btn btn-success btn-md ">
                            <i class="fas fa-paper-plane"></i> Save
                        </button>
                        &nbsp;
                        <!-- Reset Button -->
                        <button type="reset" class="btn btn-default btn-md">
                            <i class="fas fa-undo"></i> Reset
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('script')
<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>

<script>
    $(document).ready(function() {
        // Initialize select2 for the country dropdown
        $('.select2').select2();
    });
</script>
@endpush
