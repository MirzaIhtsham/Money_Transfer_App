<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileCompletionController extends Controller
{
    public function updateDetails(Request $request)
    {
        
        $validationRules = [
            'phone_no' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'id_card_no' => 'required|string|max:20',
            'country_id' => 'required|integer|exists:country,id',
        ];

        
        $documentFields = [
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'id_card_front_side' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'id_card_back_side' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'utilitybills' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'passport' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'salaryslip' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];

        foreach ($documentFields as $field => $rule) {
            if ($request->hasFile($field)) {
                $validationRules[$field] = $rule; 
            }
        }

        
        $request->validate($validationRules);

       
        $user = Auth::user();

       
        $user->update([
            'phone' => $request->phone_no,
            'address' => $request->address,
            'id_card_number' => $request->id_card_no,
            'country_id' => $request->country_id,
        ]);

        // Handle document uploads
        $userDocuments = $user->usersdocuments()->firstOrCreate(); 

        foreach ($documentFields as $field => $folder) {
            if ($request->hasFile($field)) {
                
                $oldFile = $userDocuments->$field;
                if ($oldFile) {
                    Storage::delete("uploads/{$folder}/{$oldFile}");
                }

                
                $filePath = $request->file($field)->store("uploads/{$folder}");
                $userDocuments->update([$field => basename($filePath)]);
            }
        }

        return redirect()->route('dashboard')->with('success', 'Profile updated successfully.');
    }

    public function isProfileComplete(User $user)
    {
        
        return $user->name 
            && $user->email 
            && $user->address 
            && $user->phone 
            && $user->id_card_number 
            && $user->usersdocuments?->passport 
            && $user->profession 
            && $user->usersdocuments?->salaryslip 
            && $user->country 
            && $user->usersdocuments?->utilitybills;
    }
}
