@extends('layouts.admin.master')

@section('page_title', 'Receiver')

@push('css')
<!-- Select2 Styling -->
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
<style>
    .hidden {
        display: none !important;
    }
    .form-group label {
        font-weight: bold;
        color: #495057;
    }
    .form-control, .select2-container .select2-selection--single {
        height: calc(2.25rem + 2px);
        border-radius: 0.375rem;
        border: 1px solid #ced4da;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
    .form-control:focus, .select2-container--default .select2-selection--single:focus {
        border-color: #80bdff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }
    .invalid-feedback {
        display: block;
    }
</style>
@endpush

@section('content')
@section('specific_title', 'Receiver')
@section('title', 'Receiver')

<div class="container my-5">
    <!-- Progress Bar -->
    <div class="mb-4">
        <div class="d-flex justify-content-between text-muted small">
            <span>Step 1: Conversion Details</span>
            <span>Step 2: Receiver Info</span>
            <span>Step 3: Payment</span>
        </div>
        <div class="progress" style="height: 5px;">
            <div class="progress-bar bg-primary" role="progressbar" style="width: 66%;" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
    </div>

    <!-- Receiver Information Card -->
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Step 2: Receiver Information</h4>
        </div>
        <div class="card-body">
            <p class="text-muted">Provide receiver details for the transaction.</p>
            <form method="POST" action="{{ route('process.transaction') }}">
                @csrf
                <!-- Receiver Type Selection -->
                <div class="form-group">
                    <label>Select Receiver Type:</label>
                    <div class="d-flex">
                        <div class="form-check mr-4">
                            <input type="radio" id="existingReceiver" name="receiver_type" value="existing" class="form-check-input" onchange="toggleReceiverFields()" {{ session('receiver_type', 'existing') === 'existing' ? 'checked' : '' }}>
                            <label class="form-check-label" for="existingReceiver">Existing Receiver</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" id="newReceiver" name="receiver_type" value="new" class="form-check-input" onchange="toggleReceiverFields()" {{ session('receiver_type') === 'new' ? 'checked' : '' }}>
                            <label class="form-check-label" for="newReceiver">New Receiver</label>
                        </div>
                    </div>
                    @error('receiver_type')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            
                <!-- Existing Receiver Dropdown -->
                <div id="existing-receiver" class="form-group">
                    <label for="receiver_id">Existing Receiver:</label>
                    <select id="receiver_id" name="receiver_id" class="form-control select2 @error('receiver_id') is-invalid @enderror">
                        <option value="" selected>Select Receiver</option>
                        @foreach ($receivers as $receiver)
                            <option value="{{ $receiver->id }}" {{ session('receiver_id') == $receiver->id ? 'selected' : '' }}>
                                {{ $receiver->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('receiver_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            
                <!-- New Receiver Fields -->
                <fieldset id="new-receiver" class="hidden">
                    <legend>New Receiver Details</legend>
                    <div class="form-group">
                        <label for="new_receiver_name">Name:</label>
                        <input id="new_receiver_name" name="new_receiver_name" type="text" class="form-control @error('new_receiver_name') is-invalid @enderror" value="{{ session('new_receiver_name') }}">
                        @error('new_receiver_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="new_receiver_email">Email:</label>
                        <input id="new_receiver_email" name="new_receiver_email" type="email" class="form-control @error('new_receiver_email') is-invalid @enderror" value="{{ session('new_receiver_email') }}">
                        @error('new_receiver_email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
            
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input id="address" name="address" type="text" class="form-control @error('address') is-invalid @enderror" value="{{ session('address') }}">
                        @error('address')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
            
                    <div class="form-group">
                        <label for="phone">Phone:</label>
                        <input id="phone" name="phone" type="text" class="form-control @error('phone') is-invalid @enderror" value="{{ session('phone') }}">
                        @error('phone')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
            
                    <div class="form-group">
                        <label for="id_card_number">ID Card Number:</label>
                        <input id="id_card_number" name="id_card_number" type="text" class="form-control @error('id_card_number') is-invalid @enderror" value="{{ session('id_card_number') }}">
                        @error('id_card_number')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
            
                    <div class="form-group">
                        <label for="account_number">Account Number:</label>
                        <input id="account_number" name="account_number" type="text" class="form-control @error('account_number') is-invalid @enderror" value="{{ session('account_number') }}">
                        @error('account_number')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </fieldset>
            
                <!-- Payout Method -->
                <div class="form-group">
                    <label for="payout_method_id">Payout Method:</label>
                    <select id="payout_method_id" name="payout_method_id" class="form-control select2 @error('payout_method_id') is-invalid @enderror">
                        <option value="" selected>Select a Payout Method</option>
                        @foreach ($payoutMethods as $method)
                            <option value="{{ $method->id }}" {{ session('payout_method_id') == $method->id ? 'selected' : '' }}>
                                {{ $method->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('payout_method_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            
                <!-- Navigation Buttons -->
                <div class="mt-4 d-flex justify-content-between">
                    <a href="{{ route('send.money') }}" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-primary">Proceed to Payment</button>
                </div>
            </form>
            
        </div>
    </div>
</div>
@endsection

@push('script')
<script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
<script>
    function toggleReceiverFields() {
        const existingReceiver = document.getElementById('existing-receiver');
        const newReceiver = document.getElementById('new-receiver');
        const isExistingSelected = document.getElementById('existingReceiver').checked;

        if (isExistingSelected) {
            existingReceiver.classList.remove('hidden');
            newReceiver.classList.add('hidden');
        } else {
            existingReceiver.classList.add('hidden');
            newReceiver.classList.remove('hidden');
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        toggleReceiverFields();
    });
</script>
@endpush
