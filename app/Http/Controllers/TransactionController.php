<?php

namespace App\Http\Controllers;

use App\Models\Receiver;
use App\Models\PayoutMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\Transaction;
use App\Models\ExchangeRate;
use App\Models\UserLedger;
use App\Models\User;
use App\Models\Currenices;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function processForm(Request $request)
{
    // General validation for all fields first
    $validator = Validator::make($request->all(), [
        'from_currency' => 'required|exists:currenices,id',
        'to_currency' => 'required|exists:currenices,id',
        'amount' => 'required|numeric|min:0',
        'receiver_type' => 'required|in:existing,new',
        'receiver_id' => 'required_if:receiver_type,existing|exists:receivers,id',
        'new_receiver_name' => 'required_if:receiver_type,new',
        'payout_method_id' => 'required|exists:payout_method,id',
    ]);

    // If the receiver type is new, validate new receiver's details
    if ($request->receiver_type === 'new') {
        $validator->addRules([
            'new_receiver_email' => 'required|email|unique:receivers,email', // Unique email validation
            'phone' => 'required|unique:receivers,phone', // Unique phone validation
            'address' => 'required',
            'id_card_number' => 'required',
            'account_number' => 'required|unique:receivers,account_number', // Unique account number validation
        ]);
    }

    // Validate based on the rules
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Fetch currencies
    $fromCurrency = Currenices::findOrFail($request->from_currency);
    $toCurrency = Currenices::findOrFail($request->to_currency);

    // Simulate an exchange rate calculation (this could be fetched dynamically)
    $exchangeRate = ExchangeRate::where('sending_currency_id', $request->from_currency)
        ->where('receiving_currency_id', $request->to_currency)
        ->value('rate');

    $convertedAmount = $request->amount * $exchangeRate;

    // Fetch or create receiver details
    if ($request->receiver_type === 'existing') {
        $receiver = Receiver::findOrFail($request->receiver_id);
    } else {
        // Create new receiver
        try {
            $receiver = Receiver::create([
                'name' => $request->new_receiver_name,
                'email' => $request->new_receiver_email,
                'phone' => $request->phone,
                'address' => $request->address,
                'id_card_number' => $request->id_card_number,
                'account_number' => $request->account_number,
                'user_id' => Auth::user()->id,
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            // Catch database exceptions related to unique constraint violations
            if ($e->getCode() == 23000) { // 23000 is the error code for integrity constraint violation
                return redirect()->back()->with('error', 'Duplicate entry found. Please check the receiver details.');
            }
            throw $e; // Rethrow if it's not a duplicate entry error
        }
    }

    // Fetch payout method
    $payoutMethod = PayoutMethod::findOrFail($request->payout_method_id);

    // Pass data to the summary view
    return view('transaction.summary', [
        'fromCurrency' => $fromCurrency,
        'toCurrency' => $toCurrency,
        'amount' => $request->amount,
        'convertedAmount' => $convertedAmount,
        'exchangeRate' => $exchangeRate,
        'receiver' => $receiver,
        'payoutMethod' => $payoutMethod,
    ]);
}
}
