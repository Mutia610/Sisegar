<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shipping;
use App\Http\Resources\ShippingResource;

class ShippingController extends Controller
{
    public function getOngkir(Request $request)
    {
        $idSeller = $request->input('id_user');
        $kota = $request->input('kota');

        $ongkir = Shipping::where([
            ['id_user', $idSeller],
            ['kota', $kota]
            ])->get();

        if ($ongkir->isEmpty()) {
            return response()->json([
                'status' => FALSE,
                'msg' => 'Produk Tidak ditemukan dengan kategori tersebut'
            ], 200);
        }

        return response()->json([
            "status" => TRUE,
            "data" => ShippingResource::collection($ongkir)
        ]);
    }

    // public function getOngkir()
    // {
    //     return ShippingResource::collection(Shipping::all());
    // }
}