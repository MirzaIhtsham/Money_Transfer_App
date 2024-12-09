@extends('layouts.admin.master')
@section('page_title', 'Conversion')

@section('content')
@section('specific_title', 'Conversion')
@section('title', 'Conversion')
@include('layouts.alerts')
<div class="container my-5">
    <!-- Progress Bar -->
    <div class="mb-4">
        <div class="d-flex justify-content-between text-muted small">
            <span>Step 1: Conversion Details</span>
            <span>Step 2: Receiver Info</span>
            <span>Step 3: Payment</span>
        </div>
        <div class="progress" style="height: 5px;">
            <div class="progress-bar bg-primary" role="progressbar" style="width: 33%;" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
    </div>

    <!-- Conversion Card -->
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Step 1: Conversion Details</h4>
        </div>
        <div class="card-body">
            <p class="text-muted">Select the currencies and amount you wish to convert.</p>
            <form method="POST" action="{{ route('calculate.conversion') }}" enctype="multipart/form-data">
                @csrf

                <!-- From Currency -->
                <div class="form-group">
                    <label for="sending_currency_id" class="font-weight-bold">From Currency:</label>
                    <select id="sending_currency_id" name="sending_currency_id" class="form-control @error('sending_currency_id') is-invalid @enderror">
                        <option value="" disabled>Select a Currency</option>
                        @foreach ($currencys as $currency)
                            <option 
                                value="{{ $currency->id }}" 
                                {{ old('sending_currency_id', session('sending_currency_id')) == $currency->id ? 'selected' : '' }}>
                                {{ $currency->code }}
                            </option>
                        @endforeach
                    </select>
                    @error('sending_currency_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- To Currency -->
                <div class="form-group mt-3">
                    <label for="receiving_currency_id" class="font-weight-bold">To Currency:</label>
                    <select id="receiving_currency_id" name="receiving_currency_id" class="form-control @error('receiving_currency_id') is-invalid @enderror">
                        <option value="" disabled>Select a Currency</option>
                        @foreach ($currencys as $currency)
                            <option 
                                value="{{ $currency->id }}" 
                                {{ old('receiving_currency_id', session('receiving_currency_id')) == $currency->id ? 'selected' : '' }}>
                                {{ $currency->code }}
                            </option>
                        @endforeach
                    </select>
                    @error('receiving_currency_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Amount -->
                <div class="form-group mt-3">
                    <label for="amount" class="font-weight-bold">Amount:</label>
                    <input 
                        type="number" 
                        id="amount" 
                        name="amount" 
                        class="form-control @error('amount') is-invalid @enderror" 
                        value="{{ old('amount', session('amount')) }}" 
                        required>
                    @error('amount')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Exchange Rate Error -->
                @if ($errors->has('exchange_rate'))
                    <div class="alert alert-danger mt-3">
                        {{ $errors->first('exchange_rate') }}
                    </div>
                @endif

                <!-- Submit Button -->
                <div class="mt-4 d-flex justify-content-between">
                    <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Perform Transaction</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
