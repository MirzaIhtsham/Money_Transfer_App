{{-- <x-app-layout>

    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">   
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        <div class="max-w-xl">
    <form method="post" action="{{ route('currency.add-currency') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('post')


        

        <div>
            <x-input-label for="currency" :value="__('Currency Name:')" />
            <x-text-input id="currency" name="currency_name" type="text" class="mt-1 block w-full" :value="old('currency_name')" : required autofocus autocomplete="currency_name" />
            <x-input-error :messages="$errors->get('currency_name')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="code" :value="__('Currency Code:')" />
            <x-text-input id="code" name="currency_code" type="text" class="mt-1 block w-full" :value="old('currency_code')"   : required autofocus autocomplete="currency_code" />
            <x-input-error :messages="$errors->get('currency_code')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="currency" :value="__('Country:')" />
            <select id="currency" name="country_id" class="mt-1 block w-full bg-transparent" :value="old('country_id')"     :required autofocus autocomplete="currency_name">
                <option value="" :value="old('country_id', $currency->country_id) == ''" :selected="old('country_id', $currency->country_id) == ''">Select a Currency</option>
                @foreach ($countries as $country)
                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                @endforeach
                
                
            </select>
            <x-input-error :messages="$errors->get('country_id')" class="mt-2" />
        </div>
       

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Add new currency') }}</x-primary-button>

           
        </div>
    </form>
</div>
</div>
</div>    

 --}}





{{-- <div class="form-group">
    <label>Minimal</label>
    <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
      <option selected="selected" data-select2-id="3">Alabama</option>
      <option data-select2-id="33">Alaska</option>
      <option data-select2-id="34">California</option>
      <option data-select2-id="35">Delaware</option>
      <option data-select2-id="36">Tennessee</option>
      <option data-select2-id="37">Texas</option>
      <option data-select2-id="38">Washington</option>
    </select><span class="select2 select2-container select2-container--default select2-container--below" dir="ltr" data-select2-id="2" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-ssxk-container"><span class="select2-selection__rendered" id="select2-ssxk-container" role="textbox" aria-readonly="true" title="Alabama">Alabama</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
  </div> --}}



  @extends('layouts.admin.master')
@section('page_title', 'Add Currency')

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



@section('specific_title', 'Add Currency')
@section('title', 'Add Currency')
@section('content')
<!-- Main content section -->
<section class="content">
<div class="container-fluid">
    <div class="row">
        <!-- Card for form layout -->
        <div class="col-12">
            <div class="card card-primary" style="border-radius: 12px; padding: 20px;">
                <div class="card-header bg-primary text-white text-center d-flex justify-content-between">
                    <h3 class="card-title"><i class="fas fa-plus"></i> Add Currency</h3>

                    <a href="{{ route('currencies.index') }}" class="btn btn-secondary btn-md ml-auto">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>

                <!-- Form start -->
                <form action="{{ route('currency.add-currency') }}" method="POST">
                    @csrf
                    @method('post')
                    <div class="card-body">
                        <!-- Currency Name Field -->
                        <div class="form-group">
                            <label for="currency_name">Currency Name:</label>
                            <input id="currency_name" name="currency_name" type="text" class="form-control @error('currency_name') is-invalid @enderror" placeholder="Enter the name of the currency" value="{{ old('currency_name') }}" required>
                            @error('currency_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Currency Code Field -->
                        <div class="form-group">
                            <label for="currency_code">Currency Code:</label>
                            <input id="currency_code" name="currency_code" type="text" class="form-control @error('currency_code') is-invalid @enderror" placeholder="Enter the currency code" value="{{ old('currency_code') }}" required>
                            @error('currency_code')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Country Dropdown -->
                        <div class="form-group">
                            <label for="country_id">Country:</label>
                            <select id="country_id" name="country_id" class="form-control select2 @error('country_id') is-invalid @enderror" style="width: 100%;" required>
                                <option value="" disabled selected>Select a country</option>
                                @foreach ($countries as $country)
                                <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                                @endforeach
                            </select>
                            @error('country_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

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
