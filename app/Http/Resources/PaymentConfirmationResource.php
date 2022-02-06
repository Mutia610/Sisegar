<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentConfirmationResource extends JsonResource
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
            'created_at' => $this->created_at,
            'id_order' => $this->id_order,
            'total_tagihan' => $this->total_tagihan,
            'nominal_transfer' => $this->nominal_transfer,
            'bukti_bayar' => "/uploads/" . $this->bukti_bayar
        ];
    }
}
