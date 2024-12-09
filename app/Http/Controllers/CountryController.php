<?php

namespace App\Http\Controllers;

use App\Http\Requests\CountryRequest;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CountryController extends Controller
{
    
    


     public function index()
    {
        $countries = DB::table('country')
        ->select('name', 'id')
        ->get();
        return view('country.index', compact('countries'));
    }

    public function create()
    {
        return view('country.add-country');
    }

    public function store(CountryRequest $request)
    {
       DB::beginTransaction();
        try {
            Country::create([
                'name' => $request->name,
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
           
            //throw $th;
        }
        
        return redirect()->route('country.index')->with('success', 'Country added successfully!');
    }

    public function edit(Country $country)
    {
        return view('country.edit', compact('country'));
    }

    public function update(CountryRequest $request, Country $country)
    {
        DB::beginTransaction();
       try {

        $country->update([
            'name' => $request->name,  
                       
        ]);
        DB::commit();

       } catch (\Exception $e) {
        DB::rollBack();
        return response()->json(['error' => $e->getMessage()], 500);
        
       }

       
        return redirect()->route('country.index')->with('success', 'Country updated successfully!');
    }

    public function destroy(Country $country)
    {
        DB::beginTransaction();
        try {
            $country->delete();
            DB::commit();

        } catch (\Exception $e) {
            
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
            
        }
       
        return redirect()->route('country.index')->with('success', 'Country deleted successfully!');
    }
}

    

