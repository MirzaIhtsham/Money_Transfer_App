<?php

namespace App\Http\Controllers;

use App\Http\Requests\PayoutMethodRequest;
use Illuminate\Http\Request;
use App\Models\PayoutMethod;
use Illuminate\Support\Facades\DB;

class PayoutMethodController extends Controller
{


    public function index()
    {
        $payoutMethods = PayoutMethod::all();
        return view('payout_method.index', compact('payoutMethods'));
    }

    
    public function create()
    {
        return view('payout_method.add-payout');
    }

    public function store(PayoutMethodRequest $request)
    {
        DB::beginTransaction();
        try {
            PayoutMethod::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
            
        }

        
        return redirect()->route('payout_method.index')->with('success', 'Payout method created successfully.');
    }

    
    public function show(PayoutMethod $payoutMethod)
    {
        return view('payout_methods.show', compact('payoutMethod'));
    }

    
    public function edit(PayoutMethod $payoutMethod)
    {
        return view('payout_method.edit', compact('payoutMethod'));
    }

    
    public function update(PayoutMethodRequest $request, PayoutMethod $payoutMethod)
    {
        DB::beginTransaction();
        try {
            $payoutMethod->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);
            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
            
        }
       
        return redirect()->route('payout_method.index')->with('success', 'Payout method updated successfully.');
    }

    
    public function destroy(PayoutMethod $payoutMethod)
    {
        DB::beginTransaction();
        try {
            $payoutMethod->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['error' => $e->getMessage()], 500);
            
        }
       
        return redirect()->route('payout_method.index')->with('success', 'Payout method deleted successfully.');
    }
}

    //

