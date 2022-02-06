<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentConfirmation;
use App\Models\StatusOrder;
use App\Models\Order;
use App\Http\Resources\PaymentConfirmationResource;
use Storage;
use Illuminate\Support\Arr;

class PaymentConfirmationController extends Controller
{
    public function insertConfirmation(Request $request)
    {
        date_default_timezone_set("Asia/Jakarta");
        
        $input = $request->all();
        $buktiBayar = $request->input('bukti_bayar');

        $fileName = "customer-bukti/" . date('YmdHis') . "." . "png";
        $uploadPath = "uploads/customer-bukti";
        $input['bukti_bayar'] = $fileName;

        file_put_contents("public/uploads/". $fileName, base64_decode($buktiBayar));

        PaymentConfirmation::create($input);
        
        if ($input) {
            $idOrder = $request->input('id_order');
           
            $update = $request->all();
            $update['status'] = "Menunggu Konfirmasi";

            $order = Order::where([['id', $idOrder]])->get();

            $order->each->update($update);

            return response()->json([
                'success' => true,
                'message' => 'Input Konfirmasi Berhasil',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Input Order Gagal',
            ], 401);
        }  
    }

    
    // public function insertConfirmation(Request $request)
    // {
    //     date_default_timezone_set("Asia/Jakarta");
        
    //     $input = $request->all();
    //     // $idOrder = $request->input('id_order');
    //     // $nama = $request->input('nama');
    //     // $no_hp = $request->input('no_hp');
    //     // $total_bayar = $request->input('total_bayar');
    //     $buktiBayar = $request->input('bukti_bayar');

    //     // $fotoFile = $request->file('bukti_bayar');
    //     // $extention = $fotoFile->getClientOriginalExtension();
    //     $fileName = "customer-bukti/" . date('YmdHis') . "." . "png";
    //     $uploadPath = env('UPLOAD_PATH') . "/customer-bukti";
    //     // $request->file('bukti_bayar')->move($uploadPath, $fileName);
    //     $input['bukti_bayar'] = "OK";

    //     file_put_contents("public/uploads/". $fileName, base64_decode($buktiBayar));

    //     // if ($idOrder == $buktiBayar) {
    //     //     $input['foto'] = "-";
    //     //     $kode = 1;
    //     // } else {
    //     //     $kode = 2;
    //     //     $fotoFile = $request->file('foto');
    //     //     $extention = $fotoFile->getClientOriginalExtension();
    //     //     $fileName = "customer-foto/" . date('YmdHis') . "." . $extention;
    //     //     $uploadPath = env('UPLOAD_PATH') . "/customer-foto";
    //     //     $request->file('foto')->move($uploadPath, $fileName);
    //     //     $input['foto'] = $fileName;
    //     // }

    //     PaymentConfirmation::create($input);
        
    //     if ($input) {

    //         // $inputSO = $request->all();
    //         // $inputSO['status'] = "Pesanan Di Proses";
    //         // StatusOrder::create($inputSO);
    
    //         // $inputO['status'] = "Menunggu Konfirmasi";
    //         // $order = Order::where([['id', $idOrder]])->get();

    //         // $order->each->update($inputO);

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Input Konfirmasi Berhasil',
    //         ], 200);
    //     } else {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Input Order Gagal',
    //         ], 401);
    //     }  
    // }
}
