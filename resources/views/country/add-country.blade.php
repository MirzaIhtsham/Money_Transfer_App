@extends('layouts.admin.master')
@section('page_title', 'Add Country')

@push('css')
<!-- Google Fonts -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
<!-- Bootstrap 4 -->
<link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
@endpush



@section('specific_title', 'Add Countries')
@section('title', 'Add Country')
@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

    <!-- Bootstrap Card with custom width and styling -->
    <div class="card card-primary" style="width: 100%;  border-radius: 12px; padding: 20px;">
        <div class="card-header bg-primary text-white text-center d-flex justify-content-between">
            <h3 class="card-title"> <i class="fas fa-plus"></i> Add Country</h3>

            <a href="{{ route('country.index') }}" class="btn btn-secondary btn-md ml-auto">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </div>

        <!-- Form start -->
        <form action="{{ route('country.add-country') }}" method="POST">
            @csrf
            @method('post')
            <div class="card-body">
                <!-- Country Name Field -->
                <div class="form-group">
                    <label for="country">Country Name:</label>
                    <input id="country" name="name" type="text" class="form-control" placeholder="Enter the name of the country" value="{{ old('name') }}" required>
                    @error('name')
                    <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="card-footer d-flex ">
                <!-- Save Button -->
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

@push('js')
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
@endpush
