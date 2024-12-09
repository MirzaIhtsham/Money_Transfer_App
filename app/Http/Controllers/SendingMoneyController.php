<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReceiverRequest;
use App\Models\ExchangeRate;
use App\Models\Receiver;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Currenices;
use App\Models\PayoutMethod;
use App\Models\UserLedger;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SendingMoneyController extends Controller
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
    public function conversionForm()
    {
        try {

            $currencies = ExchangeRate::distinct()->get(['sending_currency_id', 'receiving_currency_id']);
            $currencys = Currenices::all();
            return view('transaction.conversion', compact('currencies', 'currencys'));
        } catch (\Exception $e) {
            return back()->with('error', 'Unable to perform conversion form. Please try again later.');
        }
    }

    public function calculateConversion(Request $request)
    {
        try {
            $request->validate([
                'sending_currency_id' => 'required|exists:currenices,id',
                'receiving_currency_id' => 'required|exists:currenices,id',
                'amount' => 'required|numeric|min:0.01',
            ]);

            $rate = ExchangeRate::where('sending_currency_id', $request->sending_currency_id)
                ->where('receiving_currency_id', $request->receiving_currency_id)
                ->value('rate');

            if (!$rate) {
                return back()->with('error', 'Exchange rate not found for the selected currencies.');
            }

            $convertedAmount = $request->amount * $rate;

            session([
                'sending_currency_id' => $request->sending_currency_id,
                'receiving_currency_id' => $request->receiving_currency_id,
                'amount' => $request->amount,
                'convertedAmount' => $convertedAmount,
                'rate' => $rate,
            ]);
            
            return redirect()->route('receiver.info');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred during conversion. Please try again.');
        }
    }

    public function receiverInfoForm()
    {
        try {
            $receivers = Receiver::where('user_id', Auth::user()->id)->get();
            $payoutMethods = PayoutMethod::all();

            return view('transaction.receiver', compact('receivers', 'payoutMethods'));
        } catch (\Exception $e) {
            return back()->with('error', 'Unable to load the receiver info form. Please try again later.');
        }
    }
    public function sendMoneyBack()
    {
        
        $sending_currency=session('sending_currency_id');
        $sending_currency_name=Currenices::find($sending_currency)->code;
        $receiving_currency=session('receiving_currency_id');
        $receiving_currency_name=Currenices::find($receiving_currency)->code;
        $amount=session('amount');
        $currencys = Currenices::all();
        return view('transaction.conversion',compact('sending_currency_name','receiving_currency_name','amount','currencys'));
    
    }


    

    public function processTransaction(ReceiverRequest $request)
    {
        $user=Auth::user();
        // dd($user->id);
        // dd($request->receiver_id);
        
        DB::beginTransaction();

         try {
           

            
            if ($request->receiver_id) {
                $receiver = Receiver::find($request->receiver_id);
            } else {
                $receiver = Receiver::updateOrCreate(
                    [
                        'user_id' => $user->id,
                        'email' => $request->new_receiver_email
                    ],
                    [
                    'name' => $request->new_receiver_name,
                    'email' => $request->new_receiver_email,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'id_card_number' => $request->id_card_number,
                    'account_number' => $request->account_number,
                    'user_id' => $user->id

                ]);
             
            }

            session([
                'receiver' => $receiver,
                'payout_method_id' => $request->payout_method_id,

            ]);
           
            DB::commit();

        

       return redirect()->route('transaction.summary');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }


public function transactionSummary(Request $request)
{   
    
    try {
        $sendingCurrency = session('sending_currency_id');
        $sendingCurrency = Currenices::find($sendingCurrency);
        // dd($sendingCurrency);
        $receivingCurrency = session('receiving_currency_id');
        $receivingCurrency = Currenices::find($receivingCurrency);
        $receiver = session('receiver');

        $payoutMethod = session('payout_method_id');
        $payoutMethod = PayoutMethod::find($payoutMethod);
        $amount = session('amount');
        
        $exchangeRate = session('rate');
        $convertedAmount = $amount * $exchangeRate;

        return view('transaction.summary', compact(
            'sendingCurrency',
            'receivingCurrency',
            'amount',
            'exchangeRate',
            'convertedAmount',
            'receiver',
            'payoutMethod'
        ));
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'An error occurred while processing your request.');
    }
}
public function completeTransaction(Request $request)
{
    
     try {

        $user = User::findOrFail(Auth::user()->id);

        if ($request->amount > $user->balance) {
            return redirect()->route('dashboard')->with('error', 'Insufficient balance.');
        }

        $user->balance -= $request->amount;
        $user->save();
        DB::beginTransaction();
        Transaction::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'sending_currency_id' => $request->sending_currency_id,
            'receiving_currency_id' => $request->receiving_currency_id,
            'amount' => $request->amount,
            'payable' => $request->converted_amount,
            'exchange_rate' => $request->exchange_rate,
            'payout_method_id' => $request->payout_method_id,
            'transaction_type' => 'send',
            'invoice_filename' => 'invoice_' . uniqid() . '.pdf',
        ]);
        DB::commit();
        session()->forget(['sending_currency_id', 'receiving_currency_id', 'amount', 'converted_amount', 'exchange_rate', 'receiver', 'payout_method_id']);

        return redirect()->route('dashboard')->with('success', 'Transaction completed successfully!');
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->with('error', 'An error occurred while completing the transaction.');
    }
}




public function transactionHistory()
{
    $transactions = Transaction::with(['sendingCurrency', 'receivingCurrency', 'receiver', 'payoutMethod'])
                                ->where('sender_id', auth()->id())
                                ->orderBy('created_at', 'desc')
                                ->get();
    // return $transactions;

    return view('transaction.history', compact('transactions'));
}

public function transactionadminhistory()
{
    $transactions = Transaction::with(['sendingCurrency', 'receivingCurrency', 'receiver', 'payoutMethod'])
                                ->orderBy('created_at', 'desc')
                                ->get();
    $netCashFlow = Transaction::where('status', 'completed')->sum('cash_flow');
    // return $transactions;

    return view('transaction.adminhistory', compact('transactions','netCashFlow'));
}
public function transactionupdatestatus(Request $request)
{
    //  dd($request->all());
    $sender=$request->sender;
    $receiver=$request->receiver;
    $transactions=$request->transaction;
    
    
    
     if($request->status=='cancelled'){
        $amount=$request->amount;
        
        $sender = User::findOrFail($request->sender);
        $sender->balance=$sender->balance+$amount;
        $sender->save();
         

     }
    
    $transaction = Transaction::find($request->id);
    
    $transaction->status = $request->status;

    if ($request->status == 'completed') {
    $transaction->cash_flow=$request->amount;
    $user=User::findOrFail($request->sender);
    $balance=$user->balance;
    
    $transaction->sender->userlegder()->create([
        'debit' => $request->amount,
        'credit' => 0,
        'transaction_id' => $transactions,
        'balance' => $balance
    ]);

   $transaction->receiver->userlegder()->create([
    'debit' => 0,
    'credit' => $request->amount,
    'transaction_id' => $transactions,
    'balance' => $request->amount
   ]);

    
    }else if ($request->status == 'cancelled') {
        $transaction->cash_flow=0;
    }else{
        $transaction->cash_flow=0;
        $user=User::findOrFail($request->sender);
        $balance=$user->balance;
        $transaction->sender->userlegder()->create([
            'debit' => 0 ,
            'credit' => $request->amount,
            'transaction_id' => $transactions,
            'balance' => $balance
        ]);
        $User=User::findOrFail($request->sender);
        $User->balance=$User->balance+$request->amount;
        $User->save();

       $transaction->receiver->userlegder()->create([
        'debit' => $request->amount,
        'credit' => 0,
        'transaction_id' => $transactions,
        'balance' => $request->amount
       ]);
    }

    $transaction->save();
    return redirect()->route('transaction.admin.history')->with('success', 'Transaction status updated successfully!');



}

public function cancel(Transaction $transaction)
{
    if ($transaction->status == 'in_progress') {
        $transaction->status = 'Cancelled';
        $transaction->save();

        return redirect()->back()->with('success', 'Transaction has been cancelled.');
    }

    return redirect()->back()->with('error', 'This transaction cannot be cancelled.');
}

public function start(Transaction $transaction)
{
    if ($transaction->status == 'cancelled') {
        $transaction->status = 'in_progress';
        $transaction->save();

        return redirect()->back()->with('success', 'Transaction has been started.');
    }

    return redirect()->back()->with('error', 'This transaction cannot be started.');
}


}







