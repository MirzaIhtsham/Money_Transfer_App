<?php

namespace App\Models;

use Faker\Provider\ar_EG\Payment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = ['id'];



    public function receiver()
    {
        return $this->belongsTo(Receiver::class); 
    }

    public function sender()
    {
        return $this->belongsTo(User::class); 
    }

    public function sendingCurrency()
    {
        return $this->belongsTo(Currenices::class); 
    }

    public function receivingCurrency()
    {
        return $this->belongsTo(Currenices::class); 
    }

    public function payoutmethod()
    {
        return $this->belongsTo(PayoutMethod::class, 'payout_method_id'); 
    }
  


    
}
