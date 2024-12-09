<?php

namespace App\Http\Controllers;

use App\Models\Receiver;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportingController extends Controller
{
    
    public function showReport(Request $request)
    {   
        $user = Auth::user();
        $transactions = Transaction::where('sender_id', $user->id)->get();
        $receivers = Receiver::all();
        
        
        return view('transaction.reporting', compact('transactions', 'receivers'));
    }
    public function showSenderReport(Request $request)
    {
        $user = Auth::user(); 
        DB::enableQueryLog(); 

        
        $query = Transaction::where('sender_id', $user->id);

        
        if ($request->has('date_from') && $request->has('date_to')) {
            $query->whereBetween('created_at', [
                Carbon::parse($request->date_from)->startOfDay(),
                Carbon::parse($request->date_to)->endOfDay()
            ]);
        } else {
            return back()->with('error', 'Date From and Date To are required.');
        }

       
        if ($request->filled('receiver')) {
            $query->where('receiver_id', $request->receiver);
        }

        
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

       
        $transactions = $query->get();

       

       
        $receivers = Receiver::all();
       

       
        return view('transaction.reporting', compact('transactions', 'receivers' ));
    }

   
    public function downloadInvoice($transactionId)
    {
        $transaction = Transaction::findOrFail($transactionId);

       
        $pdf = \PDF::loadView('transaction.invoices', compact('transaction'));

        
        return $pdf->download('invoice-' . $transaction->id . '.pdf');
    }

    public function showadmin(Request $request)
    {   
        
        $transactions = Transaction::all();
        $receivers = Receiver::all();
        
        
        return view('transaction.adminreporting', compact('transactions', 'receivers'));
    }

    public function showAdminReport(Request $request)
    {
        $query = Transaction::query();
    
        
        if ($request->filled('date_from') && $request->filled('date_to')) {
            
            $dateFrom = \Carbon\Carbon::parse($request->date_from)->startOfDay();
            $dateTo = \Carbon\Carbon::parse($request->date_to)->endOfDay();
    
            $query->whereBetween('created_at', [$dateFrom, $dateTo]);
        }
    
        
        if ($request->filled('receiver')) {
            $query->where('receiver_id', $request->receiver);
        }
    
       
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
    
       
        $transactions = $query->get();
    
        
        $receivers = Receiver::all();
    
        
        return view('transaction.adminreporting', compact('transactions', 'receivers'));
    }
    

    
   
}
    

