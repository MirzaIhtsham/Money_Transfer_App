{{-- <x-app-layout>

    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">   
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        <div class="max-w-xl">
    <form method="post" action="{{ route('exchange_rate.update', $exchangeRate->id) }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @if(isset($exchangeRate))
            @method('PUT')
        @endif
       

        
        <div>
            <x-input-label for="currency" :value="__('From Currency:')" />
            <select id="currency" name="sending_currency_id" class="mt-1 block w-full bg-transparent" :required autofocus autocomplete="currency_name">
                @foreach($currencies as $currency)
                <option value="{{ $currency->id }}"
                    {{ isset($exchangeRate) && $exchangeRate->sending_currency_id == $currency->id ? 'selected' : '' }}>
                    {{ $currency->name }} ({{ $currency->code }})
                </option>
                @endforeach
                
                
            </select>
            <x-input-error :messages="$errors->get('sending_currency_id')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="currency" :value="__('To Currency:')" />
            <select id="currency" name="receiving_currency_id" class="mt-1 block w-full bg-transparent" :required autofocus autocomplete="currency_name">
                @foreach($currencies as $currency)
                <option value="{{ $currency->id }}"
                    {{ isset($exchangeRate) && $exchangeRate->receiving_currency_id == $currency->id ? 'selected' : '' }}>
                    {{ $currency->name }} ({{ $currency->code }})
                </option>
            @endforeach
                
                
            </select>
            <x-input-error :messages="$errors->get('receiving_currency_id')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="rate" :value="__('Exchange Rate:')" />
            <x-text-input id="rate" name="rate" type="text" class="mt-1 block w-full" :value="old('rate', $exchangeRate->rate)" : required autofocus autocomplete="currency_name" />
            <x-input-error :messages="$errors->get('rate')" class="mt-2" />
        </div>
       

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Update') }}</x-primary-button>


            <a href="{{ route('exchange_rates.index') }}" class="px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white rounded">Back to Exchange Rate List</a>
        </div>
    </form>
</div>

        </div>
    </div>
   



</x-app-layout> --}}


@extends('layouts.admin.master')
@section('page_title', 'Edit Exchange Rate')


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


@section('specific_title', 'Edit Exchange Rate')
@section('title', 'Edit Exchange Rate')
@section('content')
<!-- Main content section -->
<section class="content">
<div class="container fluid">
    <div class="row">
        <!-- Card for form layout -->
        <div class="col-12">
            <div class="card card-primary" style="border-radius: 12px; padding: 20px;">
                <div class="card-header bg-primary text-white text-center d-flex justify-content-between">
                    <h3 class="card-title"><i class="fas fa-edit"></i> Edit Exchange Rate</h3>

                    <a href="{{ route('exchange_rates.index') }}" class="btn btn-secondary btn-md ml-auto">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>

                <!-- Form start -->
                <form action="{{ route('exchange_rate.update', $exchangeRate->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                   
                    <!-- From Currency Dropdown -->
                    <div class="form-group">
                        <label for="sending_currency_id">From Currency:</label>
                        <select id="sending_currency_id" name="sending_currency_id" class="form-control select2 @error('sending_currency_id') is-invalid @enderror" style="width: 100%;" required>
                            <option value="" disabled>Select a currency</option>
                            @foreach ($currencies as $currency)
                                <option value="{{ $currency->id }}" 
                                    @if($currency->id == old('sending_currency_id', $exchangeRate->sending_currency_id)) selected @endif>
                                    {{ $currency->code }}
                                </option>
                            @endforeach
                        </select>
                        @error('sending_currency_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- To Currency Dropdown -->
                    <div class="form-group">
                        <label for="receiving_currency_id">To Currency:</label>
                        <select id="receiving_currency_id" name="receiving_currency_id" class="form-control select2 @error('receiving_currency_id') is-invalid @enderror" style="width: 100%;" required>
                            <option value="" disabled>Select a currency</option>
                            @foreach ($currencies as $currency)
                                <option value="{{ $currency->id }}" 
                                    @if($currency->id == old('receiving_currency_id', $exchangeRate->receiving_currency_id)) selected @endif>
                                    {{ $currency->code }}
                                </option>
                            @endforeach
                        </select>
                        @error('receiving_currency_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Exchange Rate Field -->
                    <div class="form-group">
                        <label for="rate">Exchange Rate:</label>
                        <input id="rate" name="rate" type="text" class="form-control @error('rate') is-invalid @enderror" placeholder="Enter the exchange rate" value="{{ old('rate', $exchangeRate->rate) }}" required>
                        @error('rate')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
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
</section>

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




