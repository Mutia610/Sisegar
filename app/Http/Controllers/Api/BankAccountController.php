<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BankAccount;
use App\Http\Resources\BankAccountResource;

class BankAccountController extends Controller
{
    public function getByIdUser(Request $request)
    {
        $idUser = $request->input('id_user');

        $data = BankAccount::where([['id_user', $idUser]])->get();

        if ($data->isEmpty()) {
            return response()->json([
                'status' => FALSE,
                'msg' => 'Rekening Tidak ditemukan dengan kategori tersebut'
            ], 200);
        }

        return response()->json([
            "status" => TRUE,
            "data" => BankAccountResource::collection($data)
        ]);
    }
}
