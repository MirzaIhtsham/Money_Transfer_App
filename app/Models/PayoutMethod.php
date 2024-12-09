<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayoutMethod extends Model
{
    use HasFactory;
    protected $table = 'payout_method';
    protected $fillable = [
        'name',
        'description',
    ];


    public function transaction()
    {
        return $this->hasMany(Transaction::class); // A country has many users
    }
}
