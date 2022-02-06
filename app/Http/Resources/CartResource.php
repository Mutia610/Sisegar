<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
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
            'id_customer' => $this->id_customer,
            'id_user' => $this->id_user,
            'id_kategori' => $this->id_kategori,
            'id_produk' => $this->id_produk,
            'username' => $this->username,
            'name' => $this->name,
            'nama_kategori' => $this->nama_kategori,
            'nama' => $this->nama,
            'deskripsi' => $this->deskripsi,
            'harga' => $this->harga,
            'satuan' => $this->satuan,
            'gambar' => "/uploads/" . $this->gambar_item,
            'jumlah' => $this->jumlah,
            'total_harga' => $this->total_harga,
        ];
    }
}
