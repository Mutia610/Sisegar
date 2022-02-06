<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user','no_rekening_penerima','no_rekening_pengirim','jumlah_transfer','bukti_transfer'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id_user');
    }

    public function bank_account()
    {
        return $this->belongsTo('App\Models\BankAccount', 'no_rekening_penerima');
    }
}
