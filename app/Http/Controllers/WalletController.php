<?php

namespace App\Http\Controllers;

use App\Http\Requests\Wallet;

use App\Models\User;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WalletController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $user = Auth::user();

            
            if (!$this->profileComplete($user)) {
                return redirect()->route('profile.edit')->with('error', 'Please complete your profile before making transactions.');
            }

            return $next($request);
        });
    }

    protected function profileComplete($user)
    {
        return $user->name && $user->email && $user->address && $user->phone && $user->country_id;
    }
    public function show()
    {
        try {
            $user = User::findOrFail(Auth::user()->id);
            return view('wallet.show', compact('user'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'User not found.');
        }
        
    }

    
    public function updatebalance(Wallet $request, $id)
    {
       DB::beginTransaction();
        try {
            $user = User::findOrFail($id);
             $user->balance += $request->amount;
             $user->save();
             DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Balance update failed.');
           
        }
       
        return redirect()->back()->with('success', 'Balance updated successfully.');
    }

   
    public function withdrawBalance(Wallet $request, $id)
    {
        DB::beginTransaction();
        try {
            $user = User::findOrFail($id);

        if ($request->amount > $user->balance) {
            return redirect()->back()->with('error', 'Insufficient balance.');
        }

        $user->balance -= $request->amount;
        $user->save();
        DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Balance withdraw failed.');
            
        }
       

        return redirect()->back()->with('success', 'Balance withdrawn successfully.');
    }




}