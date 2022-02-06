<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'id_kategori' => $this->id_kategori,
            'nama_kategori' => $this->nama_kategori,
            'id_user' => $this->id_user,
            'seller' => $this->name,
            'hp_toko' => $this->user->phone,
            'alamat_toko' => $this->user->address,
            'nama' => $this->nama,
            'deskripsi' => $this->deskripsi,
            'harga' => $this->harga,
            'satuan' => $this->satuan,
            'stok' => $this->stok,
            'batas_pengiriman' => $this->batas_pengiriman,
            'gambar' => "/uploads/" . $this->gambar_item
        ];
    }
}
