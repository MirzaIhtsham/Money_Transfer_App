@extends('layouts.admin.master')

@section('page_title', 'Report')

@push('css')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
@endpush

@push('script')
<!-- jQuery and DataTables JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        // Initialize DataTables on the table
        $('.table').DataTable({
            paging: true,          // Enable pagination
            searching: true,       // Enable search
            ordering: true,        // Enable sorting on columns
            info: true,            // Show info (e.g., showing 1 to 10 of 100 entries)
            responsive: true,      // Make table responsive on mobile
            lengthChange: false    // Disable the option to change the number of rows displayed
        });
    });
</script>
@endpush

@section('content')
@section('specific_title', 'Report')
@section('title', 'Report')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="callout callout-info">
                    <h5><i class="fas fa-info"></i> Note:</h5>
                    Please select the required filters below to generate the report.
                </div>

                <!-- Filters Form -->
                <form action="{{ route('showSenderReport') }}" method="POST">
                    @csrf
                    @method('POST')

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="date_from">Date From</label>
                                <input type="date" name="date_from" id="date_from" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="date_to">Date To</label>
                                <input type="date" name="date_to" id="date_to" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="receiver">Receiver</label>
                                <select name="receiver" id="receiver" class="form-control">
                                    <option value="">Select Receiver</option>
                                    @foreach ($receivers as $receiver)
                                        <option value="{{ $receiver->id }}">{{ $receiver->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="status">Transaction Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="">Select Status</option>
                                    <option value="paid">Paid</option>
                                    <option value="in_progress">Progress</option>
                                    <option value="cancelled">Cancelled</option>
                                    <option value="refund">Refund</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Generate Report</button>
                </form>

                <hr>

                <!-- Display Transactions -->
                <div class="invoice p-3 mb-3">
                    <div class="row">
                        <div class="col-12">
                            <h4>Sender Report</h4>
                            <small class="float-right">Date: {{ now()->format('d/m/Y') }}</small>
                        </div>
                    </div>

                    <!-- Table row -->
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Transaction ID</th>
                                        <th>Sender</th>
                                        <th>Receiver</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Amount</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($transactions as $transaction)
                                    <tr>
                                        <td>{{ $transaction->id }}</td>
                                        <td>{{ $transaction->sender->name}}</td>
                                        <td>{{ $transaction->receiver->name }}</td>
                                        <td>{{ $transaction->created_at->format('d/m/Y') }}</td>
                                        <td>{{ ucfirst($transaction->status) }}</td>
                                        <td>{{ $transaction->amount }}</td>
                                        <td>
                                            <a href="{{ route('transaction.invoice', $transaction->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-download"></i> Download Invoice
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No transactions found with the selected filters.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
@endsection
