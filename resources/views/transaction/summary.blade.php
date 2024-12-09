{{-- <x-app-layout>
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto p-8 bg-gradient-to-r from-blue-50 to-blue-100 shadow-lg rounded-lg">
        <h1 class="block  text-3xl text-gray-700 dark:text-gray-300 font-extrabold">Transaction Summary</h1>

        <div class="space-y-6 py-4">
            
            <div class="flex justify-between items-center bg-white p-4 rounded-lg shadow-md">
                <span class="text-gray-600 font-medium">From Currency:</span>
                <span class="text-blue-700 font-bold">{{ $sendingCurrency->name }} ({{ $sendingCurrency->code }})</span>
            </div>

           
            <div class="flex justify-between items-center bg-white p-4 rounded-lg shadow-md">
                <span class="text-gray-600 font-medium">To Currency:</span>
                <span class="text-blue-700 font-bold">{{ $receivingCurrency->name }} ({{ $receivingCurrency->code }})</span>
            </div>

            
            <div class="flex justify-between items-center bg-white p-4 rounded-lg shadow-md">
                <span class="text-gray-600 font-medium">Amount to Send:</span>
                <span class="text-green-600 font-bold">{{ number_format($amount, 2) }}</span>
            </div>

            
            <div class="flex justify-between items-center bg-white p-4 rounded-lg shadow-md">
                <span class="text-gray-600 font-medium">Exchange Rate:</span>
                <span class="text-green-600 font-bold">{{ $exchangeRate }}</span>
            </div>

           
            <div class="flex justify-between items-center bg-white p-4 rounded-lg shadow-md">
                <span class="text-gray-600 font-medium">Converted Amount:</span>
                <span class="text-green-600 font-bold">{{ number_format($convertedAmount, 2) }}</span>
            </div>

            
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-lg font-bold text-gray-700 border-b border-gray-200 pb-2 mb-4">Receiver Information</h2>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600 font-medium">Name:</span>
                        <span class="text-gray-900 font-bold">{{ $receiver->name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600 font-medium">Email:</span>
                        <span class="text-gray-900 font-bold">{{ $receiver->email }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600 font-medium">Account Number:</span>
                        <span class="text-gray-900 font-bold">{{ $receiver->account_number }}</span>
                    </div>
                </div>
            </div>

           
            <div class="flex justify-between items-center bg-white p-4 rounded-lg shadow-md">
                <span class="text-gray-600 font-medium">Payout Method:</span>
                <span class="text-blue-700 font-bold">{{ $payoutMethod->name }}</span>
            </div>
        </div>

       
        <div class="mt-8 text-center">
            <form action="{{ route('complete.transaction') }}" method="POST" class="inline-block">
                @csrf
                <input type="hidden" name="receiver_id" value="{{ $receiver->id }}">
                <input type="hidden" name="amount" value="{{ $amount }}">
                <input type="hidden" name="converted_amount" value="{{ $convertedAmount }}">
                <input type="hidden" name="sending_currency_id" value="{{ $sendingCurrency->id }}">
                <input type="hidden" name="receiving_currency_id" value="{{ $receivingCurrency->id }}">
                <input type="hidden" name="exchange_rate" value="{{ $exchangeRate }}">
                <input type="hidden" name="payout_method_id" value="{{ $payoutMethod->id }}">

                <div class="flex items-center gap-4 py-6">
                    <x-primary-button>{{ __('Pay Now') }}</x-primary-button>
                    <a href="{{ route('receiver.info') }}" class="px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white rounded">Back to Previous Step</a>
                    
                </div>
            </form>
        </div>
    </div>
    </div>
</x-app-layout>








 --}}



 @extends('layouts.admin.master')

 @section('page_title', 'Transaction Summary')
 
 @push('css')
 <!-- Google Fonts -->
 <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
 <!-- Font Awesome -->
 <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
 <!-- Bootstrap 4 -->
 <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}">
 <!-- Select2 -->
 <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
 <!-- AdminLTE -->
 <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
 @endpush
 
 @section('specific_title', 'Transaction Summary')
 @section('title', 'Transaction Summary')
 
 @section('content')
 @include('layouts.alerts')
 
 <div class="container mt-5">
     <div class="row justify-content-center">
         <div class="col-md-8">
             <!-- Progress Bar -->
             <div class="mb-4">
                 <div class="d-flex justify-content-between text-muted small">
                     <span>Step 1: Conversion Details</span>
                     <span>Step 2: Receiver Info</span>
                     <span>Step 3: Payment</span>
                 </div>
                 <div class="progress" style="height: 5px;">
                     <div class="progress-bar bg-primary" role="progressbar" style="width: 100%;" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                 </div>
             </div>
 
             <div class="card shadow-lg rounded-lg">
                 <div class="card-header bg-primary text-white text-center">
                     <h3 class="card-title">Transaction Summary</h3>
                 </div>
 
                 <div class="card-body">
                     <!-- From Currency -->
                     <div class="card mb-3">
                         <div class="card-body">
                             <div class="d-flex justify-content-between">
                                 <span class="font-weight-bold">From Currency:</span>
                                 <span>{{ $sendingCurrency ? $sendingCurrency->name : 'N/A' }} ({{ $sendingCurrency ? $sendingCurrency->code : 'N/A' }})</span>
                             </div>
                         </div>
                     </div>
 
                     <!-- To Currency -->
                     <div class="card mb-3">
                         <div class="card-body">
                             <div class="d-flex justify-content-between">
                                 <span class="font-weight-bold">To Currency:</span>
                                 <span>{{ $receivingCurrency ? $receivingCurrency->name : 'N/A' }} ({{ $receivingCurrency ? $receivingCurrency->code : 'N/A' }})</span>
                             </div>
                         </div>
                     </div>
 
                     <!-- Amount to Send -->
                     <div class="card mb-3">
                         <div class="card-body">
                             <div class="d-flex justify-content-between">
                                 <span class="font-weight-bold">Amount to Send:</span>
                                 <span>{{ number_format($amount, 2) }}</span>
                             </div>
                         </div>
                     </div>
 
                     <!-- Exchange Rate -->
                     <div class="card mb-3">
                         <div class="card-body">
                             <div class="d-flex justify-content-between">
                                 <span class="font-weight-bold">Exchange Rate:</span>
                                 <span>{{ $exchangeRate }}</span>
                             </div>
                         </div>
                     </div>
 
                     <!-- Converted Amount -->
                     <div class="card mb-3">
                         <div class="card-body">
                             <div class="d-flex justify-content-between">
                                 <span class="font-weight-bold">Converted Amount:</span>
                                 <span>{{ number_format($convertedAmount, 2) }}</span>
                             </div>
                         </div>
                     </div>
 
                     <!-- Receiver Information -->
                     <div class="card mb-3">
                         <div class="card-header">
                             <h5 class="card-title mb-0">Receiver Information</h5>
                         </div>
                         <div class="card-body">
                             <div class="d-flex justify-content-between">
                                 <span class="font-weight-bold">Name:</span>
                                 <span>{{ $receiver->name ?? 'N/A' }}</span>
                             </div>
                             <div class="d-flex justify-content-between">
                                 <span class="font-weight-bold">Email:</span>
                                 <span>{{ $receiver->email ?? 'N/A' }}</span>
                             </div>
                             <div class="d-flex justify-content-between">
                                 <span class="font-weight-bold">Account Number:</span>
                                 <span>{{ $receiver->account_number ?? 'N/A' }}</span>
                             </div>
                         </div>
                     </div>
 
                     <!-- Payout Method -->
                     <div class="card mb-3">
                         <div class="card-body">
                             <div class="d-flex justify-content-between">
                                 <span class="font-weight-bold">Payout Method:</span>
                                 <span>{{ $payoutMethod->name ?? 'N/A' }}</span>
                             </div>
                         </div>
                     </div>
 
                     <!-- Final Confirmation -->
                     <div class="text-center">
                         <form action="{{ route('complete.transaction') }}" method="POST">
                             @csrf
                             <input type="hidden" name="receiver_id" value="{{ $receiver->id }}">
                             <input type="hidden" name="amount" value="{{ $amount }}">
                             <input type="hidden" name="converted_amount" value="{{ $convertedAmount }}">
                             <input type="hidden" name="sending_currency_id" value="{{ $sendingCurrency->id }}">
                             <input type="hidden" name="receiving_currency_id" value="{{ $receivingCurrency->id }}">
                             <input type="hidden" name="exchange_rate" value="{{ $exchangeRate }}">
                             <input type="hidden" name="payout_method_id" value="{{ $payoutMethod->id }}">
 
                             <div class="d-flex justify-content-center gap-4 py-4">
                                 <button type="submit" class="btn btn-success btn-lg">{{ __('Pay Now') }}</button>
                                 <a href="{{ route('send.money') }}" class="btn btn-primary btn-lg">Back to Previous Step</a>
                             </div>
                         </form>
                     </div>
                 </div>
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
 @endpush
 