<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user', 'nama', 'nama_toko', 'deskripsi', 'kota'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
