<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currenices extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'country_id',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class); 
    }



    public function exchangerate()
    {
        return $this->hasOne(ExchangeRate::class , 'sending_currency_id'); 
    }
    public function receivingexchangerate()
    {
        return $this->hasOne(ExchangeRate::class , 'receiving_currency_id'); 
    }

    public function transaction()
    {
        return $this->hasMany(Transaction::class); 
    }


    


}
