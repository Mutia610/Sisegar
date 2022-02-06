<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user', 'kota', 'biaya'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function kota()
    {
        return $this->belongsTo('App\Models\City');
    }
}
