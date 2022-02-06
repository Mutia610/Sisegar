<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
       'id_user', 'id_kategori', 'id_satuan', 'nama', 'deskripsi', 'harga', 'satuan', 'stok', 'batas_pengiriman','gambar_item'
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'id_kategori');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id_user');
    }

    public function unit()
    {
        return $this->belongsTo('App\Models\Unit', 'id_satuan');
    }
}
