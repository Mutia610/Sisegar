<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Customer;
use Validator;
use App\Http\Resources\CartResource;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    
    function getJmlKeranjang(Request $request)
    {
        $idCustomer = $request->input('id_customer');

         $jumlah = Cart::where('id_customer', $idCustomer)->count();

        return response()->json([
            'status' => TRUE,
            'msg' => 'Data didapatkan',
            'jumlah' => $jumlah
        ], 200);
    }

    function getKeranjang(Request $request)
    {
        $idCustomer = $request->input('id_customer');

         $cart = Db::table('carts')
         ->join('customers', 'carts.id_customer', '=' , 'customers.id')
         ->join('users', 'carts.id_user', '=' , 'users.id')
         ->join('categories', 'carts.id_kategori', '=' , 'categories.id')
         ->join('items', 'carts.id_produk', '=' , 'items.id')
         ->join('units', 'items.id_satuan', '=' , 'units.id')
         ->select('carts.id', 'carts.id_customer', 'customers.username', 'carts.id_user', 'users.name', 'carts.id_kategori', 'categories.nama_kategori', 'carts.id_produk', 'items.nama', 'items.deskripsi', 'items.harga', 'satuan', 'items.gambar_item', 'jumlah', 'total_harga')
         ->where([['id_customer', $idCustomer]])
         ->get();
 
        // if ($cart->isEmpty()) {
        //     return response()->json([
        //         'status' => FALSE,
        //         'msg' => 'Keranjang Kosong'
        //     ], 200);
        // }

        return CartResource::collection($cart);
    }

    function getKeranjangRecycler(Request $request)
    {
        $idCustomer = $request->input('id_customer');
        $idUser = $request->input('id_user');

         $cart = Db::table('carts')
         ->join('customers', 'carts.id_customer', '=' , 'customers.id')
         ->join('users', 'carts.id_user', '=' , 'users.id')
         ->join('categories', 'carts.id_kategori', '=' , 'categories.id')
         ->join('items', 'carts.id_produk', '=' , 'items.id')
         ->join('units', 'items.id_satuan', '=' , 'units.id')
         ->select('carts.id', 'carts.id_customer', 'customers.username', 'carts.id_user', 'users.name', 'users.address', 'carts.id_kategori', 'categories.nama_kategori', 'carts.id_produk', 'items.nama', 'items.deskripsi', 'items.harga', 'satuan', 'items.stok', 'batas_pengiriman', 'items.gambar_item', 'jumlah', 'total_harga')
         ->where([['id_customer', $idCustomer], ['carts.id_user', $idUser]])
         ->get();
 
        if ($cart->isEmpty()) {
            return response()->json([
                'status' => FALSE,
                'msg' => 'Keranjang Kosong'
            ], 200);
        }

        $jml = $cart->count();
        $totHargaAll = 0;
        $totalBerat = 0;

        if($jml > 0){
            foreach($cart as $data){
                $item['id_user'] = $data->id_user;
                $item['seller'] = $data->name; 
                $item['alamat_seller'] = $data->address; 
                
                $x['id_keranjang'] = $data->id; 
                $x['id_produk'] = $data->id_produk; 
                $x['id_kategori'] = $data->id_kategori; 
                $x['nama_produk'] = $data->nama; 
                $x['nama_kategori'] = $data->nama_kategori; 
                $x['jumlah'] = $data->jumlah; 
                $x['harga'] = $data->harga; 
                $x['total_harga'] = $data->total_harga; 
                $x['satuan'] = $data->satuan;
                $x['stok'] = $data->stok; 
                $x['batas_pengiriman'] = $data->batas_pengiriman; 
                $x['gambar'] = "/uploads/" . $data->gambar_item; 

                $totHargaAll += $data->total_harga; 
                $item['tot_harga_all'] = $totHargaAll;

                $totalBerat += $data->jumlah; 
                $item['tot_berat'] = $totalBerat;

                $subData[] = $x;
	        	$item['subData'] = $subData;
            }
            return response()->json([
                'status' => TRUE,
                'msg' => 'Get Keranjang Berhasil',
                'banyak_data' => $jml,
                'data' => $item
            ], 200);
        }
    }

    function insertKeranjang(Request $request)
    {
        $idProdukInput = $request->input('id_produk');
        $idCustomerInput = $request->input('id_customer');
        $jumlahInput = $request->input('jumlah');

        $validator = validator::make($request->all(),[
            'api_key' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => FALSE,
                'msg' => $validator->errors()
            ], 400);
        }

        $apiKey = $request->input('api_key');

        $cekApiKey = Customer::where('api_key', $apiKey)->first();

        if (is_null($cekApiKey)) {
            return response()->json([
                'status' => FALSE,
                'msg' => 'API Key Customer Salah'
            ], 200);
        }else{
            $cart = Cart::where([['id_customer', $idCustomerInput], ['id_produk', $idProdukInput]])->get();

            if($cart->isEmpty()){
                $input = Cart::create([
                    'id_customer' => $request->input('id_customer'),
                    'id_user' => $request->input('id_user'),
                    'id_kategori' => $request->input('id_kategori'),
                    'id_produk' => $request->input('id_produk'),
                    'jumlah' => $request->input('jumlah'),
                    'total_harga' => $request->input('total_harga')
                ]);
        
                if ($input) {
                    return response()->json([
                    'success' => true,
                    'message' => 'Berhasil Input Keranjang',
                    ], 200);
                } else {
                    return response()->json([
                    'success' => false,
                    'message' => 'Gagal Input Keranjang',
                    ], 401);
                }
            }else{
                $input = $request->all();

                $idKeranjang = $cart[0]->id;
                $jumlahKrj = $cart[0]->jumlah;
                $harga = $cart[0]->total_harga;
                $totalJumlah = $jumlahInput + $jumlahKrj;
                $totalHarga = $harga/$jumlahKrj * $totalJumlah;

                $input['jumlah'] = $totalJumlah;
                $input['total_harga'] = $totalHarga;

                $cartUpdate = Cart::where('id', $idKeranjang)->first();
            //    $cartUpdate->update(['jumlah' => $totalJumlah], ['total_harga' => $totalHarga]);
                
                if ($cartUpdate) {
                    $cartUpdate->update($input);
                    return response()->json([
                        'success' => true,
                        'message' => $totalHarga //'Berhasil Update Keranjang'
                    ], 200);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Gagal Update Keranjang',
                    ], 401);
                }
            }
        }
    }

    
    function updateKeranjang(Request $request){
        $input = $request->all();

        $validator = validator::make($input,[
            'api_key' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => FALSE,
                'msg' => $validator->errors()
            ], 400);
        }

        $apiKey = $request->input('api_key');

        $cart = Cart::find($request->get('id'));
        $idCustomer = $cart->id_customer;
        
        $cekApiKey = Customer::where('id', '=' ,$idCustomer)
        ->where('api_key', '=' ,$apiKey)
        ->count();

        if ($cekApiKey != 1) {
            return response()->json([
                'status' => FALSE,
                'msg' => 'API Key Customer Salah'
            ], 200);
        }else{
            if (is_null($cart)) {
                return response()->json([
                    'status' => FALSE,
                    'msg' => 'Data tidak ditemukan'
                ], 404);
            }
    
            $cart->update($input);
            return response()->json([
                'status' => TRUE,
                'msg' => 'Data Berhasil Di Update'
            ], 200);
        }
    }

    function deleteKeranjang(Request $request){
        $input = $request->all();
        $cart = Cart::find($request->get('id'));
        if (is_null($cart)) {
            return response()->json([
                'status' => FALSE,
                'msg' => 'Data tidak ditemukan'
            ], 404);
        }

        $cart->delete($input);
        return response()->json([
            'status' => TRUE,
            'msg' => 'Data keranjang berhasil di hapus'
        ], 200);
    }
}
