<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileDetailsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    { 
        // dd($this->all());
        return [
            'phone_no'=>'required|string|max:20|nullable',
            'address'=>'required',
            'id_card_no'=>'required|string||max:20',
            
            'profile_pic'=>'nullable|mimes:jpeg,png,jpg,gif,svg|max:5048|required',
            'id_card_front_side'=>'nullable|mimes:jpeg,png,jpg,gif,svg|max:5048|required',
            'id_card_back_side'=>'nullable|mimes:jpeg,png,jpg,gif,svg|max:5048|required',
            'utilitybills'=>'nullable|mimes:jpeg,png,jpg,gif,svg|max:5048|required',
            'passport'=>'nullable|mimes:jpeg,png,jpg,gif,svg|max:5048|required',
            'salaryslip'=>'nullable|mimes:jpeg,png,jpg,gif,svg|max:5048|required',
            'country_id'=>'required',

        ];
    }
}




// 'address' => 'required|string|max:255',
//                     'phone_no' => 'nullable|string|max:20|required',
//                     'idcardNumber' => 'required|string',
//                     'profession' => 'required|string',
//                     'salaryslip' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:5048',
//                     'country' => 'required|string',
//                     'bankaccountNumber' => 'required|string',
//                     'utilitybills' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:5048',
//                     'passport' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:5048',
//                     'dob'=>'required',
