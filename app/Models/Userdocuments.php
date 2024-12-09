<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Userdocuments extends Model
{
    use HasFactory;

    protected $table = 'userdoucments';

    protected $guarded=['id'];



    public function users()
    {
        return $this->belongsTo(user::class); 
    }
}
