<?php

namespace App\Http\Controllers;

use App\Http\Requests\CurrencyRequest;
use App\Models\Country;
use App\Models\Currenices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CurrencyController extends Controller
{
    public function index()
    {
        $currencies = Currenices::with('country')->get();

        // return $currencies;
         return view('currency.index', compact('currencies'));
    }

    public function create()
    {
        $countries = Country::all();
        return view('currency.add-currency', compact('countries'));
    }

    public function store(CurrencyRequest $request)
    {
        // dd($request->all());
        DB::beginTransaction();
        try {
            Currenices::create([
                'name' => $request->currency_name,
                'code' => $request->currency_code,
                'country_id' => $request->country_id
            ]);
            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage() ], 500);
            
            
        }
       
        return redirect()->route('currencies.index')->with('success', 'Currency added successfully!');
    }

    public function edit(Currenices $currency)
    {
        // return $currency;
        $countries = Country::all();
        return view('currency.edit', compact('currency', 'countries'));
    }

    public function update(CurrencyRequest $request, Currenices $currency)
    {
        
        DB::beginTransaction();
       try {

        $currency->update([
            'name' => $request->currency_name,
            'code' => $request->currency_code,
            'country_id' => $request->country_id,
        ]);
        DB::commit();
       } catch (\Exception $e) {
        DB::rollBack();

        return response()->json(['error' => $e->getMessage()], 500);
        
       }

       
        return redirect()->route('currencies.index')->with('success', 'Currency updated successfully!');
    }

    public function destroy(Currenices $currency)
    {
        DB::beginTransaction();
        try {
            $currency->delete();
            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            return  response()->json(['error' => $e->getMessage()], 500);
            
        }
        
        return redirect()->route('currencies.index')->with('success', 'Currency deleted successfully!');
    }
}

