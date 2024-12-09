<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receiver extends Model
{
    use HasFactory;

    protected $table = 'receivers';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'id_card_number',
        'account_number',
        'user_id'

    ];


    public function country()
    {
        return $this->hasOne(Country::class); 
    }

    public function transaction()
    {
        return $this->hasMany(Transaction::class); 
    }
    
    

    public function user()
    {
        return $this->belongsTo(User::class); 
    }

    public function userlegder(){
        return $this->morphMany(UserLedger::class, 'user');
    }
}
