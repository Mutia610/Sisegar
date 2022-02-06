<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Customer;
use App\Models\Category;
use App\Models\Slider;
use App\Models\Item;
use App\Models\Order;
use Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware(['auth']);
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['seller'] = User::where('level', 'seller')->count();
        $data['customer'] = Customer::count();
        $data['order'] = Order::count();
        return view('home', $data);
    }


    public function indexSeller()
    {
        $id = Auth::user()->id;
        $data['product'] = Item::where('id_user', $id)->count();
        $data['pesanan_masuk'] = Order::where([
                                            ['status', '=', "Dikemas"],
                                            ['id_user', '=', $id]
                                        ])
                                        ->orWhere([
                                            ['status', '=', "Belum Bayar"],
                                            ['id_user', '=', $id]
                                        ])
                                        ->orWhere([
                                            ['status', '=', "Menunggu Konfirmasi"],
                                            ['id_user', '=', $id]
                                        ])
                                        ->count();

        $data['pesanan_dikirim'] = Order::where([
                                            ['status', '=', "Dikirim"],
                                            ['id_user', '=', $id]
                                        ])
                                        ->count();

        $data['pesanan_diterima'] = Order::where([
                                            ['status', '=', "Diterima"],
                                            ['id_user', '=', $id]
                                        ])
                                        ->count();
                                        
        return view('homeSeller', $data);
    }
}
