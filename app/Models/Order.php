<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'created_at', 'id_user','id_customer', 'nama', 'alamat', 'total_harga', 'kurir', 'waktu_pengiriman', 'ongkir', 'pajak', 'total_bayar', 'metode_pembayaran', 'status'
    ];

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'id_customer');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id_user');
    }
}
