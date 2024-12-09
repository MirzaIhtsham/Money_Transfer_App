{{-- <x-app-layout>
    <div class="mx-auto">
        <div class="max-w-6xl mx-auto px-6 py-8">
            <h1 class="text-3xl font-extrabold text-gray-800 text-center mb-8">Transaction History</h1>

            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                

                <div class="px-6 py-4 bg-gradient-to-r from-blue-100 to-blue-200">
                    <h2 class="text-xl font-semibold text-gray-700">Your Transactions</h2>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr class="w-full bg-gray-100 border-b">
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">From Currency</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">To Currency</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount Sent</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Converted Amount</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Exchange Rate</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sender Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Receiver Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payout Method</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($transactions as $transaction)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-6 py-4 text-gray-700">{{ $transaction->created_at->format('d-m-Y H:i') }}</td>
                                    <td class="px-6 py-4 text-gray-700">{{ $transaction->sendingCurrency->code }}</td>
                                    <td class="px-6 py-4 text-gray-700">{{ $transaction->receivingCurrency->code }}</td>
                                    <td class="px-6 py-4 text-green-600 font-semibold">{{ number_format($transaction->amount, 2) }}</td>
                                    <td class="px-6 py-4 text-green-600 font-semibold">{{ number_format($transaction->payable, 2) }}</td>
                                    <td class="px-6 py-4 text-gray-700">{{ $transaction->exchange_rate }}</td>
                                    <td class="px-6 py-4 text-gray-700">{{ $transaction->sender->name }}</td>
                                    <td class="px-6 py-4 text-gray-700">{{ $transaction->receiver->name }}</td>
                                    <td class="px-6 py-4 text-gray-700">{{ $transaction->payoutMethod->name }}</td>
                                    <td class="px-6 py-4 text-gray-700">{{ $transaction->status }}</td>
                                    <td class="px-6 py-4 text-gray-700">
                                        <form method="POST" action="{{ route('admin.transactions.updateStatus', $transaction->id) }}" class="inline-block">
                                            @csrf
                                            @method('POST')
                                            <input type="hidden" name="amount" value="{{ $transaction->amount }}">
                                            <input type="hidden" name="sender" value="{{ $transaction->sender->id }}">
                                            <input type="hidden" name="receiver" value="{{ $transaction->receiver->id }}">
                                            <input type="hidden" name="transaction" value="{{ $transaction->id }}">

                                            <select name="status" id="status-{{ $transaction->id }}" class="status-select border rounded" data-transaction-status="{{ $transaction->status }}">
                                                @if ($transaction->status === 'in_progress')
                                                    <option value="completed" {{ $transaction->status === 'completed' ? 'selected' : '' }}>Paid</option>
                                                    <option value="cancelled" {{ $transaction->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                                @else
                                                    <option value="refund" {{ $transaction->status === 'refund' ? 'selected' : '' }}>Refund</option>
                                                @endif

                                                @if($transaction->status == 'cancelled')
                                                <form action="{{ route('transaction.start', $transaction->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('POST')
                                                    <x-primary-button id="updateButton" >{{ __('Again start') }}</x-primary-button>
                                                </form>
                                            @endif
                                            </select>
                                            <x-primary-button class="update-button" data-transaction-id="{{ $transaction->id }}">{{ __('Update') }}</x-primary-button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                                        No transactions found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            
            const rows = document.querySelectorAll('tr');
            
            rows.forEach(row => {
                const statusSelect = row.querySelector('.status-select');
                const updateButton = row.querySelector('.update-button');
                
                if (statusSelect && updateButton) {
                    const transactionStatus = statusSelect.getAttribute('data-transaction-status');

                    
                    if ((transactionStatus === 'refund' && statusSelect.value === 'refund')||(transactionStatus === 'cancelled' && statusSelect.value === 'refund')) {
                        statusSelect.style.display = 'none';
                        updateButton.style.display = 'none';
                    }

                    
                    statusSelect.addEventListener('change', function () {
                        if (transactionStatus === 'refund' && this.value === 'refund') {
                            statusSelect.style.display = 'none';
                            updateButton.style.display = 'none';
                        }
                    });
                }
                
            });
        });
    </script>
</x-app-layout>


 --}}

@extends('layouts.admin.master')

@section('page_title', 'Transaction History')

@push('css')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    
@endpush


@section('specific_title', 'Transaction History')
@section('title', 'Transaction History')
@section('content')
@include('layouts.alerts')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">



<div class="card">
    <div class="card-header">
      <h3 class="card-title"><i class="fa fa-list"></i> Transaction History</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
           
          <th>Date</th>
          <th>From Currency</th>
          <th>To Currency</th>
          <th>Amount Sent</th>
          <th>Converted Amount</th>
          <th>Exchange Rate</th>
          <th>Receiver Name</th>
          <th>Payout Method</th>
          <th>Status</th>
          <th>Actions</th>
         
        </tr>
        </thead>
        <tbody>
        
        @forelse ($transactions as $transaction)
        <tr>
            <td >{{ $transaction->created_at->format('d-m-Y H:i') }}</td>
            <td >{{ $transaction->sendingCurrency->code }}</td>
            <td >{{ $transaction->receivingCurrency->code }}</td>
            <td >{{ number_format($transaction->amount, 2) }}</td>
            <td >{{ number_format($transaction->payable, 2) }}</td>
            <td >{{ $transaction->exchange_rate }}</td>
            <td >{{ $transaction->receiver->name }}</td>
            <td >{{ $transaction->payoutMethod->name }}</td>
            <td >{{ $transaction->status }}</td>

         
         
         
          <td> 
            <form method="POST" action="{{ route('admin.transactions.updateStatus', $transaction->id) }}" class="inline-block">
                @csrf
                @method('POST')
                <input type="hidden" name="amount" value="{{ $transaction->amount }}">
                <input type="hidden" name="sender" value="{{ $transaction->sender->id }}">
                <input type="hidden" name="receiver" value="{{ $transaction->receiver->id }}">
                <input type="hidden" name="transaction" value="{{ $transaction->id }}">
            
                <div class="form-group d-flex align-items-center">
                    <select name="status" id="status-{{ $transaction->id }}" class="status-select form-control custom-select mr-2" data-transaction-status="{{ $transaction->status }}">
                        @if ($transaction->status === 'in_progress')
                            <option value="completed" {{ $transaction->status === 'completed' ? 'selected' : '' }}>Paid</option>
                            <option value="cancelled" {{ $transaction->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        @else
                            <option value="refund" {{ $transaction->status === 'refund' ? 'selected' : '' }}>Refund</option>
                        @endif
                    </select>
            
                    @if($transaction->status == 'cancelled')
                        <form action="{{ route('transaction.start', $transaction->id) }}" method="POST" class="inline">
                            @csrf
                            @method('POST')
                            <x-primary-button class="btn btn-primary btn-sm" id="updateButton">{{ __('Again start') }}</x-primary-button>
                        </form>
                    @endif
            
                    <!-- Update button (styled to match the select box) -->
                    <button class="btn btn-primary btn-sm form-control update-button" data-transaction-id="{{ $transaction->id }}">
                        {{ __('Update') }}
                    </button>
                </div>
            </form>
            
          </td>
        </tr>
        @empty
        <tr>
            <td colspan="9" class="px-6 py-4 text-center text-gray-500">
                                        No transactions found.
             </td>
            </tr>
            @endforelse
       
        </tbody>
        <tfoot>
        <tr>
            <th>Date</th>
            <th>From Currency</th>
            <th>To Currency</th>
            <th>Amount Sent</th>
            <th>Converted Amount</th>
            <th>Exchange Rate</th>
            <th>Receiver Name</th>
            <th>Payout Method</th>
            <th>Status</th>
            <th>Actions</th>
          
        </tr>
        </tfoot>
      </table>
    </div>
    <!-- /.box-body -->
  </div>
        </div></div></div></section>
@endsection

@push('script')
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- DataTables  & Plugins -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        
        const rows = document.querySelectorAll('tr');
        
        rows.forEach(row => {
            const statusSelect = row.querySelector('.status-select');
            const updateButton = row.querySelector('.update-button');
            
            if (statusSelect && updateButton) {
                const transactionStatus = statusSelect.getAttribute('data-transaction-status');

                
                if ((transactionStatus === 'refund' && statusSelect.value === 'refund')||(transactionStatus === 'cancelled' && statusSelect.value === 'refund')) {
                    statusSelect.style.display = 'none';
                    updateButton.style.display = 'none';
                }

                
                statusSelect.addEventListener('change', function () {
                    if (transactionStatus === 'refund' && this.value === 'refund') {
                        statusSelect.style.display = 'none';
                        updateButton.style.display = 'none';
                    }
                });
            }
            
        });
    });
</script>
    
@endpush

