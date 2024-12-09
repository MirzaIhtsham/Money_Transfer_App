{{-- <x-app-layout>
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">   
<div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
<div class="max-w-xl">
<form method="post" action="{{ route('payout_method.add-payout') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
    @csrf
    @method('post')


    

    <div>
        <x-input-label for="payout" :value="__('Payout Method:')" />
        <x-text-input id="payout" name="name" type="text" class="mt-1 block w-full" :value="old('name')" : required autofocus autocomplete="phone" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="description" :value="__('Description:')" />
        

        <textarea id="description" rows="4" name="description" :value="old('description')" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your thoughts here..."></textarea>

        <x-input-error :messages="$errors->get('description')" class="mt-2" />
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>{{ __('Add new payout') }}</x-primary-button>


        <a href="{{ route('payout_method.index') }}" class="px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white rounded">Back to Payout List</a>

    </div>


</form>

</div>
</div>
</div>

</x-app-layout>
 --}}








@extends('layouts.admin.master')

@section('page_title', 'Payout Method')

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


@section('specific_title', 'Add Payout Method')
@section('title', 'Add Payout Method')
@section('content')
<!-- Main content section -->
<section class="content">
<div class="container-fluid">
    <div class="row">
        <!-- Card for form layout -->
        <div class="col-12">
            <div class="card card-primary" style="border-radius: 12px; padding: 20px;">
                <div class="card-header bg-primary text-white text-center d-flex justify-content-between">
                    <h3 class="card-title"><i class="fas fa-plus"></i> Add Payout Method</h3>


                    <a href="{{ route('payout_method.index') }}" class="btn btn-secondary btn-md ml-auto">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>

                <!-- Form start -->
                <form action="{{ route('payout_method.add-payout') }}" method="POST">
                    @csrf
                    @method('post')
                    <div class="card-body">
                        <!-- Currency Name Field -->
                        <div class="form-group">
                            <label for="name">Payout Method:</label>
                            <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter the name " value="{{ old('name') }}" required>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Currency Code Field -->
                        <div class="form-group">
                            <label for="currency_code">Description::</label>
                            <textarea id="description" name="description" type="text" class="form-control @error('description') is-invalid @enderror" placeholder="Enter the description" value="{{ old('description') }}" required></textarea>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Country Dropdown -->
                        

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
