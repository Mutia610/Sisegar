<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Cart;
use App\Models\Courier;
use App\Models\Item;
use App\Models\Delivery;
use App\Models\Customer;
use App\Http\Resources\OrderResource;
use App\Http\Resources\CartResource;
use Carbon\Carbon;
use Validator;


class OrderController extends Controller
{
    public function insertOrder(Request $request)
    {
        date_default_timezone_set("Asia/Jakarta");

        $input = $request->all();
        $idCustomer = $request->input('id_customer');
        $idUser = $request->input('id_user');

        $idOrder = date('dmy'). rand(0, 999);
        $input['id'] = $idOrder; 

        $input['id_user'] = $idUser; 

        if ($request->get('metode_pembayaran') == "COD") {
            $input['status'] = "Dikemas";
        } else {
            $input['status'] = "Belum Bayar";
        }

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
        
        $cekApiKey = Customer::where('id', '=' ,$idCustomer)
        ->where('api_key', '=' ,$apiKey)
        ->count();

        if ($cekApiKey != 1) {
            return response()->json([
                'status' => FALSE,
                'msg' => 'API Key Customer Salah'
            ], 200);
        }

        Order::create($input);

        if ($input) {
            $query = Cart::where([
                ['id_customer', $idCustomer],
                ['id_user', $idUser]])->get(); 
        
            if($query){
                foreach($query as $data){
                    $idUser = $data['id_user'];
                    $idProduct = $data['id_produk'];
                    $jumlah = $data['jumlah'];
                        
                    $item['id_order'] = $idOrder; 
                    $item['id_user'] = $idUser;
                    $item['id_product'] = $idProduct;
                    $item['jumlah'] = $jumlah;
            

                    OrderDetail::create($item);
                   
                    $dataStok = Item::select('stok')->where('id', '=', $idProduct)->get();
                    foreach($dataStok as $ds){
                        $stok = $ds['stok'];
                        $newStok = $stok - $jumlah;

                    }    

                    Item::where('id', $idProduct)->update(['stok' => $newStok]);
                } 
            
                 $query->each->delete();
            }

          return response()->json([
                'success' => true,
                'message' => 'Input Order Berhasil',
                'idOrder' => $idOrder
          ], 200);  
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Input Order Gagal',
             ], 401); 
        }
    }

    function getByStatusDetail(Request $request)
    {
        date_default_timezone_set("Asia/Jakarta");
        $idOrder = $request->input('id');

        $orderDetail = Db::table('order_details')
            ->join('users', 'order_details.id_user', '=' , 'users.id')
            ->join('items', 'order_details.id_product', '=' , 'items.id')
            ->join('units', 'items.id_satuan', '=' , 'units.id')
            ->select('order_details.id_user', 'users.name', 'users.phone','users.address', 'items.id', 'items.id_kategori', 'items.nama', 'items.harga', 'satuan', 'items.gambar_item', 'jumlah')
            ->where([['id_order', $idOrder]])
            ->get();
    
        $jumlahProduk = $orderDetail->count();

        if($orderDetail){
            foreach($orderDetail as $detail){
                $item['id_seller'] = $detail->id_user;  
                $item['nama_seller'] = $detail->name;
                $item['phone_seller'] = $detail->phone;
                $item['alamat_seller'] = $detail->address;
                $item['jumlah_produk'] = $jumlahProduk;

                $x['id_produk'] = $detail->id; 
                $x['id_kategori'] = $detail->id_kategori; 
                $x['nama_produk'] = $detail->nama; 
                $x['harga'] = $detail->harga; 
                $x['jumlah'] = $detail->jumlah;  
                $x['satuan'] = $detail->satuan; 
                $x['gambar'] = "/uploads/" . $detail->gambar_item; 

                $subData[] = $x;
                $item['subData'] = $subData;
            }

            return response()->json([
                "status" => TRUE,
                "data" => $item
            ]);
        }else{
            return response()->json([
                'status' => FALSE,
                'msg' => 'Produk Tidak ditemukan'
            ], 200);
        }
    }

    function getByStatusOrder(Request $request)
    {
        date_default_timezone_set("Asia/Jakarta");
        $statusOrder = $request->input('status');
        $idCustomer = $request->input('id_customer');

        $order = Order::where([['id_customer', $idCustomer],['status', $statusOrder]])
            ->orderBy('created_at', 'DESC')
            ->get();

        $jumlahData = $order->count();

        if($order->isEmpty()){
            return response()->json([
                'status' => FALSE,
                'msg' => 'Produk Tidak ditemukan dengan kategori tersebut'
            ], 200);
        }else{
            foreach($order as $data){
                $idOrder = $data['id'];
                $idCustomer = $data['id_customer'];
                $lamaPengiriman = intval($data['waktu_pengiriman']) + 1;

                $estimasiPengemasan = date('d-m-Y', strtotime('+2 days', strtotime($data['created_at'])));

                $date = Carbon::createFromFormat('Y-m-d H:i:s', $data['updated_at'])->copy()->tz('Asia/Jakarta')->format('d-m-Y');
                $estimasiPengiriman = Carbon::parse($date)->addDays($lamaPengiriman);
                
                if($statusOrder == "Dikirim" || $statusOrder == "Diterima"){
                    $kirim = Delivery::select('no_resi')->where('id_order',$idOrder)->get();
                    if($kirim){
                        foreach($kirim as $x){
                            $item['no_resi'] = $x->no_resi;
                        }
                    }
                }

                $item['id_order'] = $idOrder;
                $item['tanggal_pemesanan'] = date('d M Y', strtotime($data['created_at'])); 
                $item['created_at'] = date('d-m-Y H:i:s', strtotime($data['created_at'])); 
                $item['updated_at'] = date('d-m-Y H:i:s', strtotime($data['updated_at'])); 
                $item['est_pengemasan'] = $estimasiPengemasan;
                $item['est_pengiriman'] = date('d-m-Y', strtotime($estimasiPengiriman));
                $item['id_customer'] = $data['id_customer'];
                $item['nama_customer'] = $data['nama'];
                $item['alamat_customer'] = $data['alamat'];
                $item['total_harga'] = $data['total_harga'];
                $item['kurir'] = $data['kurir'];
                $item['ongkir'] = $data['ongkir'];
                $item['pajak'] = $data['pajak'];
                $item['total_bayar'] = $data['total_bayar'];
                $item['metode_pembayaran'] = $data['metode_pembayaran'];
                $item['status'] = $data['status'];

                $orderDetail = Db::table('order_details')
                    ->join('items', 'order_details.id_product', '=' , 'items.id')
                    ->join('units', 'items.id_satuan', '=' , 'units.id')
                    ->select('items.id', 'items.id_kategori', 'items.nama', 'items.harga', 'satuan', 'items.gambar_item', 'jumlah')
                    ->where([['id_order', $idOrder]])
                    ->get();

                $jmlProduk = $orderDetail->count();

                foreach($orderDetail as $detail){
                    $item['jml_produk'] = $jmlProduk;
                    $item['id_produk'] = $detail->id; 
                    $item['id_kategori'] = $detail->id_kategori; 
                    $item['nama_produk'] = $detail->nama; 
                    $item['harga'] = $detail->harga; 
                    $item['jumlah'] = $detail->jumlah;  
                    $item['satuan'] = $detail->satuan; 
                    $item['gambar'] = "/uploads/" . $detail->gambar_item; 
                }

                $arrayData[] = $item;
            }

            return response()->json([
                "status" => TRUE,
                "data" => $arrayData
             ]);
        }
    }

    function updateStatusOrder(Request $request){

        date_default_timezone_set("Asia/Jakarta");
        
        $idOrder = $request->input('id');

        $order = Order::where([['id', $idOrder]])->get();

        if ($order->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal Update Status',
            ], 401);
        }

        $input = $request->all();
        $order->each->update($input);

        return response()->json([
            'status' => TRUE,
            'msg' => 'Berhasil Update Status'
        ], 200);
    }
}
