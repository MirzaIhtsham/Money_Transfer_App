<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReceiverRequest extends FormRequest
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
        
        return [

            'receiver_type' => 'required|in:existing,new',
            'receiver_id' => 'nullable|exists:receivers,id',
            'new_receiver_name' => 'required_without:receiver_id',
            'new_receiver_email' => 'required_without:receiver_id',
            'payout_method_id' => 'required|exists:payout_method,id',
            'address'=>'required_without:receiver_id',
            'phone'=>'required_without:receiver_id',
            'id_card_number'=>'required_without:receiver_id',
            'account_number'=>'required_without:receiver_id',
            
            //
        ];
    }
}
