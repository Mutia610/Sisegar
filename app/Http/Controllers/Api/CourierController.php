<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\CourierResource;
use App\Models\Courier;

class CourierController extends Controller
{
    public function getCourier(Request $request)
    {
        $idSeller = $request->input('id_user');
        $idCustomer = $request->input('id_customer');

        $courier = Courier::where([
            ['id_user', $idSeller],
            ['id_customer', $idCustomer]
            ])->get();

        if ($courier->isEmpty()) {
            return response()->json([
                'status' => FALSE,
                'msg' => 'Produk Tidak ditemukan'
            ], 200);
        }

        return response()->json([
            "status" => TRUE,
            "data" => CourierResource::collection($courier)
        ]);
    }

    public function getAllCourier(Request $request)
    {
        $idCustomer = $request->input('id_customer');

        $courier = Courier::where([
            ['id_customer', $idCustomer]
            ])->get();

        if ($courier->isEmpty()) {
            return response()->json([
                'status' => FALSE,
                'msg' => 'Produk Tidak ditemukan'
            ], 200);
        }

        $jml = $courier->count();
        $totOngkir = 0;

        if($jml > 0){
            foreach($courier as $data){
                $totOngkir += $data->biaya; 
            }
        }

        return response()->json([
            "status" => TRUE,
            "data" => $totOngkir
        ]);
    }

    function insertCourier(Request $request)
    {
        $input = Courier::create([
            'id_customer' => $request->input('id_customer'),
            'id_user' => $request->input('id_user'),
            'ekspedisi' => $request->input('ekspedisi'),
            'tipe' => $request->input('tipe'),
            'lama_pengiriman' => $request->input('lama_pengiriman'),
            'biaya' => $request->input('biaya'),
        ]);

        if ($input) {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil Input kurir',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Gagal Input kurir',
            ], 401);
        }
    }

    function updateMetodeBayar(Request $request){
        $idSeller = $request->input('id_user');
        $idCustomer = $request->input('id_customer');

        $courier = Courier::where([
            ['id_user', $idSeller],
            ['id_customer', $idCustomer]
            ])->get();

        if ($courier->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal Input kurir',
            ], 401);
        }

        $input = $request->all();
        $courier->each->update($input);
        return response()->json([
            'status' => TRUE,
            'msg' => 'Data kurir berhasil diupdate'
        ], 200);
    }

    public function inUpCourier(Request $request)
    {
        $idSeller = $request->input('id_user');
        $idCustomer = $request->input('id_customer');

        $courier = Courier::where([
            ['id_user', $idSeller],
            ['id_customer', $idCustomer]
            ])->get();

        if ($courier->isEmpty()) {
            $input = Courier::create([
                'id_customer' => $request->input('id_customer'),
                'id_user' => $request->input('id_user'),
                'ekspedisi' => $request->input('ekspedisi'),
                'tipe' => $request->input('tipe'),
                'lama_pengiriman' => $request->input('lama_pengiriman'),
                'biaya' => $request->input('biaya'),
                'metode_bayar' => $request->input('metode_bayar')
            ]);
    
            if ($input) {
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil Input kurir',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal Input kurir',
                ], 401);
            }
        }

        $input = $request->all();
        $courier->each->update($input);
        return response()->json([
            'status' => TRUE,
            'msg' => 'Data kurir berhasil diupdate'
        ], 200);
    }

    function deleteCourier(Request $request){
        $idCustomer = $request->input('id_customer');
        
        $courier = Courier::where([
            ['id_customer', $idCustomer]
            ])->get();

        if (is_null($courier)) {
            return response()->json([
                'status' => FALSE,
                'msg' => 'Data tidak ditemukan'
            ], 404);
        }

        $courier->each->delete();
        return response()->json([
            'status' => TRUE,
            'msg' => 'Data kurir berhasil di hapus'
        ], 200);
    }
}
