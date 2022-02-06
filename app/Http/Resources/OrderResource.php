<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'created_at' => $this->created_at,
            'id_customer' => $this->id_customer,
            'nama' => $this->nama,
            'alamat' => $this->alamat,
            'kurir' => $this->kurir,
            'waktu_pengiriman' => $this->waktu_pengiriman,
            'ongkir' => $this->ongkir,
            'pajak' => $this->pajak,
            'total_bayar' => $this->total_bayar,
            'metode_pembayaran' => $this->metode_pembayaran,
            'status' => $this->status
        ];
    }
}
