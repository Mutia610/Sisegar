<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CourierResource extends JsonResource
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
            'id_user' => $this->id_user,
            'id_customer' => $this->id_customer,
            'ekspedisi' => $this->ekspedisi,
            'tipe' => $this->tipe,
            'lama_pengiriman' => $this->lama_pengiriman,
            'biaya' => $this->biaya,
            'metode_bayar' => $this->metode_bayar
        ];
    }
}
