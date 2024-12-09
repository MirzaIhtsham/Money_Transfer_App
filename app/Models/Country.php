<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $table = 'country';

    protected $guarded=['id'];





    public function users()
    {
        return $this->belongsTo(User::class); 
    }

    public function receiver()
    {
        return $this->belongsTo(Receiver::class); 
    }

    public function currenices()
    {
        return $this->hasOne(currenices::class); 
    }
}
