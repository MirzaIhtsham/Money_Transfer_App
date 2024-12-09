<?php

namespace App\Http\Controllers;

use App\Models\UserLedger;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Receiver;

class LedgerController extends Controller
{
    public function adminView()
    {
        $ledgers = UserLedger::all(); // Paginate results
        return view('ledger.adminledger', compact('ledgers'));
    }


    public function userView()
    {
        $userId = auth()->id();
        $ledgers = UserLedger::where('user_type', 'App\Models\User')
            ->where('user_id', $userId)
            ->orWhere(function ($query) use ($userId) {
                $query->where('user_type', 'App\Models\Receiver')
                      ->where('user_id', $userId);
            })->get();
           


            
            

        return view('ledger.userledger', compact('ledgers'));
    }


}




