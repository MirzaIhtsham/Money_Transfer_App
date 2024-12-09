<section>
    @php
        $User = Auth::user()->usersdocuments->first();
        $frontside = Auth::user()->usersdocuments->where('name', 'ID Card')->first();
        $utilitybill = Auth::user()->usersdocuments->where('name', 'Utility Bills')->first();
        $passport = Auth::user()->usersdocuments->where('name', 'Passport')->first();
        $salaryslip = Auth::user()->usersdocuments->where('name', 'Salary Slip')->first();
    @endphp

    <!-- Update Profile Section -->
    <div class="card shadow-lg mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="card-title">{{ __('Update Profile') }}</h5>
            <p class="card-text">{{ __('Update your personal information and documents to keep your account secure.') }}</p>
        </div>

        <div class="card-body">
            <form method="post" action="{{ route('profile.details') }}" enctype="multipart/form-data">
                @csrf
                @method('post')

                <!-- Profile Picture Upload -->
                <div class="mb-4">
                    <label for="profile_pic" class="form-label">{{ __('Profile Picture') }}</label>
                    <div class="d-flex align-items-center">
                        <!-- Smaller Picture Upload Field -->
                        <input type="file" class="form-control form-control-sm @error('profile_pic') is-invalid @enderror" id="profile_pic" name="profile_pic" accept="image/*" onchange="previewImage(event, 'profile_pic_preview')" style="max-width: 180px;">
                        
                        <!-- Picture Preview on the Right (pushed to the far end using ms-auto) -->
                        <div id="profile_pic_preview_container" class="ms-auto">
                            @if ($User?->front_side)
                                <img id="profile_pic_preview" src="{{ asset('storage/uploads/profilepics/' . $User?->front_side) }}" class="img-fluid rounded-circle" alt="Profile Picture" style="max-width: 100px; height: 100px;">
                            @else
                                <img id="profile_pic_preview" class="img-fluid rounded-circle d-none" style="max-width: 100px; height: 100px;" alt="Profile Picture Preview">
                            @endif
                        </div>
                    </div>
                    @error('profile_pic')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Personal Information Fields (Phone Number, Address, etc.) -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="phone_no" class="form-label">{{ __('Phone Number') }}</label>
                        <input type="text" class="form-control @error('phone_no') is-invalid @enderror" id="phone_no" name="phone_no" value="{{ old('phone_no', $user->phone) }}" required autofocus>
                        @error('phone_no')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="address" class="form-label">{{ __('Address') }}</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address', $user->address) }}" required>
                        @error('address')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label for="id_card_no" class="form-label">{{ __('ID Card Number') }}</label>
                    <input type="text" class="form-control @error('id_card_no') is-invalid @enderror" id="id_card_no" name="id_card_no" value="{{ old('id_card_no', $user->id_card_number) }}" required>
                    @error('id_card_no')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Country Selection -->
                <div class="mb-4">
                    <label for="currency" class="form-label">{{ __('Country') }}</label>
                    <select id="currency" name="country_id" class="form-select @error('country_id') is-invalid @enderror" required>
                        @php
                            $countries=DB::table('country')->get();
                        @endphp
                        <option value="" {{ old('country_id', $user->country_id) == '' ? 'selected' : '' }}>Select a country</option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}" {{ old('country_id', $user->country_id) == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                        @endforeach
                    </select>
                    @error('country_id')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Document Uploads (ID Card, Passport, Utility Bills, etc.) -->
                <div id="image_fields">
                    <!-- ID Card Front Side -->
                    <div class="mb-4">
                        <label for="id_card_front_side" class="form-label">{{ __('ID Card Front Side Picture') }}</label>
                        <div class="d-flex align-items-center">
                            <input type="file" class="form-control form-control-sm @error('id_card_front_side') is-invalid @enderror" id="id_card_front_side" name="id_card_front_side" accept="image/*" onchange="previewImage(event, 'id_card_front_preview')" style="max-width: 180px;">
                            <input type="hidden" name="id_card_front_side" value="{{ $frontside?->front_side }}">

                            <div id="id_card_front_preview_container" class="ms-auto">
                                @if ($frontside?->front_side)
                                    <img id="id_card_front_preview" src="{{ asset('storage/uploads/idcardfrontside/' . $frontside?->front_side) }}" class="img-fluid rounded" alt="ID Card Front" style="max-width: 100px; height: 100px;">
                                @else
                                    <img id="id_card_front_preview" class="img-fluid rounded d-none" alt="ID Card Front Preview" style="max-width: 100px; height: 100px;">
                                @endif
                            </div>
                        </div>
                        @error('id_card_front_side')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- ID Card Back Side -->
                    <div class="mb-4" >
                        <label for="id_card_back_side" class="form-label">{{ __('ID Card Back Side Picture') }}</label>
                        <div class="d-flex align-items-center">
                            <input type="file" class="form-control form-control-sm @error('id_card_back_side') is-invalid @enderror" id="id_card_back_side" name="id_card_back_side" accept="image/*" onchange="previewImage(event, 'id_card_back_preview')" style="max-width: 180px;">
                            <input type="hidden" name="id_card_back_side" value="{{ $frontside?->back_side }}">

                            <div id="id_card_back_preview_container" class="ms-auto ">
                                @if ($frontside?->back_side)
                                    <img id="id_card_back_preview" src="{{ asset('storage/uploads/idcardbackside/' . $frontside?->back_side) }}" class="img-fluid rounded" alt="ID Card Back" style="max-width: 100px; height: 100px;">
                                @else
                                    <img id="id_card_back_preview" class="img-fluid rounded d-none" alt="ID Card Back Preview" style="max-width: 100px; height: 100px;">
                                @endif
                            </div>
                        </div>
                        @error('id_card_back_side')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Utility Bills -->
                    <div class="mb-4">
                        <label for="utilitybills" class="form-label">{{ __('Utility Bills Picture') }}</label>
                        <div class="d-flex align-items-center">
                            <input type="file" class="form-control form-control-sm @error('utilitybills') is-invalid @enderror" id="utilitybills" name="utilitybills" accept="image/*" onchange="previewImage(event, 'utilitybills_preview')" style="max-width: 180px;">
                            <input type="hidden" name="utilitybills" value="{{ $utilitybill?->front_side }}">

                            <div id="utilitybills_preview_container" class="ms-auto">
                                @if ($utilitybill?->front_side)
                                    <img id="utilitybills_preview" src="{{ asset('storage/uploads/utilitybills/' . $utilitybill?->front_side) }}" class="img-fluid rounded" alt="Utility Bills" style="max-width: 100px; height: 100px;">
                                @else
                                    <img id="utilitybills_preview" class="img-fluid rounded d-none" alt="Utility Bills Preview" style="max-width: 100px; height: 100px;">
                                @endif
                            </div>
                        </div>
                        @error('utilitybills')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Passport -->
                    <div class="mb-4">
                        <label for="passport" class="form-label">{{ __('Passport Picture') }}</label>
                        <div class="d-flex align-items-center">
                            <input type="file" class="form-control form-control-sm @error('passport') is-invalid @enderror" id="passport" name="passport" accept="image/*" onchange="previewImage(event, 'passport_preview')" style="max-width: 180px;">
                            <input type="hidden" name="passport" value="{{ $passport?->front_side }}">

                            <div id="passport_preview_container" class="ms-auto">
                                @if ($passport?->front_side)
                                    <img id="passport_preview" src="{{ asset('storage/uploads/passports/' . $passport?->front_side) }}" class="img-fluid rounded" alt="Passport Preview" style="max-width: 100px; height: 100px;">
                                @else
                                    <img id="passport_preview" class="img-fluid rounded d-none" alt="Passport Preview" style="max-width: 100px; height: 100px;">
                                @endif
                            </div>
                        </div>
                        @error('passport')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Salary Slip -->
                    <div class="mb-4">
                        <label for="salaryslip" class="form-label">{{ __('Salary Slip') }}</label>
                        <div class="d-flex align-items-center">
                            <input type="file" class="form-control form-control-sm @error('salaryslip') is-invalid @enderror" id="salaryslip" name="salaryslip" accept="image/*" onchange="previewImage(event, 'salaryslip_preview')" style="max-width: 180px;">
                            <input type="hidden" name="salaryslip" value="{{ $salaryslip?->front_side }}">

                            <div id="salaryslip_preview_container" class="ms-auto">
                                @if ($salaryslip?->front_side)
                                    <img id="salaryslip_preview" src="{{ asset('storage/uploads/salaryslip/' . $salaryslip?->front_side) }}" class="img-fluid rounded" alt="Salary Slip" style="max-width: 100px; height: 100px;">
                                @else
                                    <img id="salaryslip_preview" class="img-fluid rounded d-none" alt="Salary Slip Preview" style="max-width: 100px; height: 100px;">
                                @endif
                            </div>
                        </div>
                        @error('salaryslip')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Save Button Aligned to Left -->
                <div class="d-flex justify-content-start">
                    <button type="submit" class="btn btn-primary">{{ __('Save Changes') }}</button>
                </div>
            </form>
        </div>
    </div>
</section>
