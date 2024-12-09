<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExchangeRate extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function fromCurrency()
    {
        return $this->belongsTo(Currenices::class, 'sending_currency_id');
    }
    
    public function toCurrency()
    {
        return $this->belongsTo(Currenices::class, 'receiving_currency_id');
    }
    
    

    

    
}
