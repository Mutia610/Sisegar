<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user', 'bank', 'no_rekening', 'atas_nama'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
