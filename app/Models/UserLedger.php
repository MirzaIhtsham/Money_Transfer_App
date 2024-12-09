<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class UserLedger extends Model
{
    use HasFactory;
    protected $table = 'userledgers';
    protected $fillable = [
        'user_type',
        'user_id',
        'debit',
        'credit',
        'balance',
        'transaction_id',
    ];




    public function user()
    {
        return $this->morphTo();
    }

    



}
