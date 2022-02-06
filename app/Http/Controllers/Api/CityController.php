<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use App\Http\Resources\CityResource;

class CityController extends Controller
{
    public function getCity()
    {
        return CityResource::collection(City::all());
    }

    public function getCityName(Request $request)
    {
        $kota = $request->input('kota');

        $data = City::where([['kota', $kota]])->get();

        if ($data->isEmpty()) {
            return response()->json([
                'status' => FALSE,
                'msg' => 'Kota Tidak ditemukan dengan kategori tersebut'
            ], 200);
        }

        return response()->json([
            "data" => CityResource::collection($data)
        ]);
    }
}
