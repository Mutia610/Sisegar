<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'api_key', 'username', 'email', 'password', 'gender', 'address', 'phone', 'foto'
    ];
}
