<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use App\Models\User;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ItemResource;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
//     public function popularAndLatest()
//     {
//         $latest = DB::table('products')
//         ->join('vw_product_latest', 'products.id', '=', 'vw_product_latest.id')
//         ->orderBy('created_at', 'DESC')
//         ->select('products.id', 'id_kategori', 'id_user', 'nama_kategori', 'seller', 'nama', 'deskripsi','harga', 'satuan', 'stok', 'gambar')
//         ->limit(7)
//         ->get();

 // $popular = DB::table('items')
        // ->join('vw_product_latest', 'products.id', '=', 'vw_product_latest.id')
        // ->join('likes', 'products.id', '=', 'likes.id_product')
        // ->orderBy('likes.jumlah_like', 'DESC')
        // ->select('products.id', 'id_kategori', 'id_user', 'nama_kategori', 'seller', 'nama', 'deskripsi','harga', 'satuan', 'stok', 'gambar')
        // ->limit(7)
        // ->get();

//         $popular = DB::table('products')
//         ->join('vw_product_latest', 'products.id', '=', 'vw_product_latest.id')
//         ->join('likes', 'products.id', '=', 'likes.id_product')
//         ->orderBy('likes.jumlah_like', 'DESC')
//         ->select('products.id', 'id_kategori', 'id_user', 'nama_kategori', 'seller', 'nama', 'deskripsi','harga', 'satuan', 'stok', 'gambar')
//         ->limit(7)
//         ->get();
            
//         return response()->json([
//             "status" => TRUE,
//             "data" => [
//                 "latest" => ProductResource::collection($latest),
//                 "popular" => ProductResource::collection($popular)
//             ]
//         ]);
//    }

    public function getAll()
    {
        $popular = Item::join('categories', 'id_kategori', '=', 'categories.id')
        ->join('users', 'id_user', '=', 'users.id')
        ->join('units', 'id_satuan', '=', 'units.id')
        ->select('items.id', 'id_kategori', 'id_user', 'nama_kategori', 'name', 'nama', 'deskripsi','harga', 'satuan', 'stok', 'batas_pengiriman','gambar_item')
        ->get();

        return response()->json([
            "status" => TRUE,
            "data" => ProductResource::collection($popular)
        ]);
    } 

    public function popular()
    {           
        $popular = Item::join('categories', 'id_kategori', '=', 'categories.id')
        ->join('users', 'id_user', '=', 'users.id')
        ->join('units', 'id_satuan', '=', 'units.id')
        ->select('items.id', 'id_kategori', 'id_user', 'nama_kategori', 'name', 'nama', 'deskripsi','harga', 'satuan', 'stok', 'batas_pengiriman','gambar_item')
        ->limit(7)
        ->get();

        return response()->json([
            "status" => TRUE,
            "data" => ProductResource::collection($popular)
        ]);
   }


   public function latest()
    {
        $latest = Item::join('categories', 'id_kategori', '=', 'categories.id')
        ->join('users', 'id_user', '=', 'users.id')
        ->join('units', 'id_satuan', '=', 'units.id')
        ->select('items.id', 'id_kategori', 'id_user', 'nama_kategori', 'name', 'nama', 'deskripsi','harga', 'satuan', 'stok', 'batas_pengiriman','gambar_item')
        ->orderBy('items.created_at', 'DESC')
        ->limit(7)
        ->get();

        return response()->json([
            "status" => TRUE,
            "data" => ProductResource::collection($latest)
        ]);
   }


    function getByCategory(Request $request)
    {
        $idKat = $request->input('id_kategori');
        $product = Item::join('categories', 'id_kategori', '=', 'categories.id')
        ->join('users', 'id_user', '=', 'users.id')
        ->join('units', 'id_satuan', '=', 'units.id')
        ->select('items.id', 'id_kategori', 'id_user', 'nama_kategori', 'name', 'nama', 'deskripsi','harga', 'satuan', 'stok', 'batas_pengiriman','gambar_item')
        ->where([['id_kategori', $idKat]])->get();

        if ($product->isEmpty()) {
            return response()->json([
                'status' => FALSE,
                'msg' => 'Produk Tidak ditemukan dengan kategori tersebut'
            ], 200);
        }

        return response()->json([
            "status" => TRUE,
            "data" => ProductResource::collection($product)
        ]);
    }

    function getByUser(Request $request)
    {
        $idUser = $request->input('id_user');
        $product = Item::join('categories', 'id_kategori', '=', 'categories.id')
        ->join('users', 'id_user', '=', 'users.id')
        ->join('units', 'id_satuan', '=', 'units.id')
        ->select('items.id', 'id_kategori', 'id_user', 'nama_kategori', 'name', 'nama', 'deskripsi','harga', 'satuan', 'stok', 'batas_pengiriman','gambar_item')
        ->where([['id_user', $idUser]])->get();

        if ($product->isEmpty()) {
            return response()->json([
                'status' => FALSE,
                'msg' => 'Produk Tidak ditemukan dengan kategori tersebut'
            ], 200);
        }

        return response()->json([
            "status" => TRUE,
            "data" => ProductResource::collection($product)
        ]);
    }

    // function getByUser(Request $request)
    // {
    //     $idUser = $request->input('id_user');
    //     $product = Item::where([['id_user', $idUser]])->get();

    //     if ($product->isEmpty()) {
    //         return response()->json([
    //             'status' => FALSE,
    //             'msg' => 'Produk Tidak ditemukan dengan kategori tersebut'
    //         ], 200);
    //     }

    //     return response()->json([
    //         "status" => TRUE,
    //         "data" => ItemResource::collection($product)
    //     ]);
    // }
}
