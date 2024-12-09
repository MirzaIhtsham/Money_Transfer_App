<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExchangeRateRequest;
use App\Models\ExchangeRate;
use Illuminate\Http\Request;
use App\Models\Currenices;
use Illuminate\Support\Facades\DB;

class ExchangeRateController extends Controller
{
    public function index()
    {
        $exchangeRates = ExchangeRate::with('fromCurrency', 'toCurrency')->get();
        // return $exchangeRates;
         return view('exchange_rates.index', compact('exchangeRates'));
    }

    public function create()
    {
        $currencies = Currenices::all();
        return view('exchange_rates.add-exchange-rate',compact('currencies'));
    }

    public function store(ExchangeRateRequest $request)
    {
        DB::beginTransaction();
        try {
            
            $existingExchangeRate = ExchangeRate::where('sending_currency_id', $request->sending_currency_id)
                                                 ->where('receiving_currency_id', $request->receiving_currency_id)
                                                 ->exists();
            
            if ($existingExchangeRate) {
                return redirect()->route('exchange_rates.index')->with('error', 'Exchange rate for this currency pair already exists.');
            }
    
           
            ExchangeRate::create([
                'sending_currency_id' => $request->sending_currency_id,
                'receiving_currency_id' => $request->receiving_currency_id,
                'rate' => $request->rate,
            ]);
    
            DB::commit();
    
            return redirect()->route('exchange_rates.index')->with('success', 'Exchange rate added successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('exchange_rates.index')->with('error', 'Error: ' . $e->getMessage());
        }
    }
    

    public function edit(ExchangeRate $exchangeRate)
    {
        $currencies = Currenices::all();
        return view('exchange_rates.edit', compact('exchangeRate', 'currencies'));
    }

    // Update an existing exchange rate in the database
    public function update(Request $request, ExchangeRate $exchangeRate)
    {
        $request->validate([
            'sending_currency_id' => 'required|exists:currenices,id',
            'receiving_currency_id' => 'required|exists:currenices,id|different:sending_currency_id',
            'rate' => 'required|numeric|min:0',
        ]);
    
        // Check if the combination of sending and receiving currencies already exists, excluding the current exchange rate
        $existingExchangeRate = ExchangeRate::where('sending_currency_id', $request->sending_currency_id)
                                             ->where('receiving_currency_id', $request->receiving_currency_id)
                                             ->where('id', '!=', $exchangeRate->id) // Exclude the current record from the check
                                             ->exists();
    
        if ($existingExchangeRate) {
            // If the combination already exists, return with an error message
            return redirect()->route('exchange_rates.index')->with('error', 'Exchange rate for this currency pair already exists.');
        }
    
        // Proceed with the update if no duplicate combination is found
        $exchangeRate->update([
            'sending_currency_id' => $request->sending_currency_id,
            'receiving_currency_id' => $request->receiving_currency_id,
            'rate' => $request->rate,
        ]);
    
        return redirect()->route('exchange_rates.index')->with('success', 'Exchange rate updated successfully.');
    }
    


    public function destroy(ExchangeRate $exchangeRate)
    {
        DB::beginTransaction();
        try {
            $exchangeRate->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            throw response()->json(['error' => $e->getMessage() ], 500);
            
        }
        
        return redirect()->route('exchange_rates.index')->with('success', 'Exchange rate deleted successfully!');
    }
}






