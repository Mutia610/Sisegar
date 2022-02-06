<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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
            'api_key' => $this->api_key,
            'username' => $this->username,
            'email' => $this->email,
            'password' => $this->password,
            'gender' => $this->gender,
            'address' => $this->address,
            'phone' => $this->phone,
            'foto' => "/uploads/" . $this->foto
        ];
    }
}
