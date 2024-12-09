{{-- 
<x-app-layout>
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">  
<div class="container mx-auto py-10">
    <div class="max-w-3xl mx-auto space-x-8 flex"> <!-- Add flex to the parent div -->

        
        <div class="p-6 rounded-lg shadow-lg flex-1 flex justify-end"> 
            <h1 class="text-9xl font-semibold text-center mb-6 text-gray-900 whitespace-nowrap dark:text-white">Exchange Rates</h1>
        </div>

        
        <div class="p-6 rounded-lg shadow-lg flex-1 flex justify-end">
            <a href="{{ route('exchange_rate.add-exchange_rate') }}">
                <button class="px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white rounded">Add New Exchange Rate</button>
            </a>
        </div>
        
    </div>
</div>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    No.
                </th>
                <th scope="col" class="px-6 py-3">
                    From Currency
                </th>
                <th scope="col" class="px-6 py-3">
                    To Currency
                </th>
                <th scope="col" class="px-6 py-3">
                    Exchange Rate
                </th>
                <th scope="col" class="px-6 py-3">
                    Actions
                </th>
                
            </tr>
        </thead>
        <tbody>
            @php
                $sno=1;
             @endphp
           @forelse($exchangeRates as $exchangeRate)
           <tr>
               <td class="px-6 py-4 text-center">{{ $sno++ }}</td>
               <td class="px-6 py-4 text-center">{{ $exchangeRate->fromCurrency->name }} ({{ $exchangeRate->fromCurrency->code }})</td>
               <td class="px-6 py-4 text-center">{{ $exchangeRate->toCurrency->name }} ({{ $exchangeRate->toCurrency->code }})</td>
               <td class="px-6 py-4 text-center">{{ $exchangeRate->rate }}</td>

>
                <td class="px-6 py-4 text-center">
                    <a href="{{ route('exchange_rate.edit', $exchangeRate->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                    <a href="{{ route('exchange_rate.destroy', $exchangeRate->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Delete</a>
                </td>
                
            </tr>
            @endforeach
   
        </tbody>
    </table>
</div>
</div>

</x-app-layout> --}}










@extends('layouts.admin.master')

@section('page_title', 'Exchange Rates')

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



@section('specific_title', 'Exchange Rates')
@section('title', 'Exchange Rates')
@section('content')
@include('layouts.alerts')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">


          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title"><i class="fa fa-list"></i> Exchange Rates List</h3>
                <!-- Add Country Button at the right side -->
                <a href="{{ route('exchange_rate.add-exchange_rate') }}" class="btn btn-primary ml-auto">
                    <i class="fas fa-plus"></i> Add Exchange Rate
                </a>
            </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>No.</th>
          <th>From Currency</th>
          <th>To Currency</th>
          <th>Exchange Rate</th>
          <th>Actions</th>
         
        </tr>
        </thead>
        <tbody>
        @php
            $sno=1;
         @endphp
        @forelse($exchangeRates as $exchangeRate)
        <tr>
          <td>{{ $sno++ }}</td>
          <td>{{ $exchangeRate->fromCurrency->name }} ({{ $exchangeRate->fromCurrency->code }}) </td>
          <td> {{ $exchangeRate->toCurrency->name }} ({{ $exchangeRate->toCurrency->code }})</td>
          <td>{{ $exchangeRate->rate }} </td>
         
         
          <td> <a href="{{ route('exchange_rate.edit', $exchangeRate->id) }}" class="btn btn-primary">
            <i class="fas fa-edit"></i> Edit
        </a>
        <!-- Delete Button with Icon -->
        <a href="{{ route('exchange_rate.destroy', $exchangeRate->id) }}" class="btn btn-danger" 
           onclick="return confirm('Are you sure you want to delete this currency?');">
            <i class="fas fa-trash-alt"></i> Delete
        </a> </td>
            {{-- <td>
                <div class="btn-group">
                  <!-- Action Button -->
                  <button type="button" class="btn btn-info">Action</button>
              
                  <!-- Dropdown Toggle Button -->
                  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
              
                  <!-- Dropdown Menu -->
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{ route('country.edit', $country->id) }}">Edit</a>
                    <a class="dropdown-item" href="{{ route('country.destroy', $country->id) }}">Delete</a>
                  </div>
                </div>
              </td> --}}
        </tr>
        @endforeach
       
        </tbody>
        <tfoot>
        <tr>
            <th>No.</th>
          <th>From Currency</th>
          <th>To Currency</th>
          <th>Exchange Rate</th>
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
    
@endpush


