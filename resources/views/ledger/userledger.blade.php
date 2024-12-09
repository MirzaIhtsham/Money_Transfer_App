{{-- <x-app-layout>
    
    <div class=" max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 ">
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
                            
            
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Transaction ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Debit</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Credit</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created At</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($ledgers as $ledger)
                            <tr class="border-b hover:bg-gray-50">
                

                               

                              

                                
                                <td class="px-6 py-4 text-gray-700">{{ $ledger->id }}</td>
                                <td class="px-6 py-4 text-gray-700">{{ $ledger->transaction_id }}</td>
                                <td class="px-6 py-4 text-gray-700">{{ $ledger->type_id == auth()->id() ? 'Sender' : 'Receiver' }}</td>
                                
                                <td class="px-6 py-4 text-green-600 font-semibold">{{ $ledger->debit }}</td>
                                <td class="px-6 py-4 text-green-600 font-semibold">{{ $ledger->credit }}</td>
                        
                                
                                <td class="px-6 py-4 text-gray-700">{{ $ledger->created_at->format('Y-m-d H:i:s') }}</td>
                        
                             
        
                                
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
</x-app-layout>

 --}}


@extends('layouts.admin.master')
@section('page_title', 'Transaction Ledger')




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

@section('content')
@section('specific_title', 'Ledger')
@section('title', 'Ledger')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">



<div class="card">
    <div class="card-header">
      <h3 class="card-title"><i class="fa fa-list"></i> Transaction Ledger</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>

            <th >ID</th>
            <th >Transaction ID</th>
            <th >Type ID</th>
            <th >Debit</th>
            <th >Credit</th>
            <th >Created At</th>
 

          
         
        </tr>
        </thead>
        <tbody>
        @php
            $sno=1;
         @endphp
        @forelse ($ledgers as $ledger)
        <tr>
            <td >{{ $ledger->id }}</td>
            <td >{{ $ledger->transaction_id }}</td>
            <td >{{ $ledger->type_id == auth()->id() ? 'Sender' : 'Receiver' }}</td>
                                
            <td >{{ $ledger->debit }}</td>
            <td >{{ $ledger->credit }}</td>
                        
                                
            <td >{{ $ledger->created_at->format('Y-m-d H:i:s') }}</td>
                        
        </tr>
        @empty
        <tr>
            <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                No transactions found.
            </td>
        </tr>
        @endforelse
        </tbody>

        <tfoot>
        <tr>
            <th >ID</th>
            <th >Transaction ID</th>
            <th >Type ID</th>
            <th >Debit</th>
            <th >Credit</th>
            <th >Created At</th>
            
          
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
    
@endpush


