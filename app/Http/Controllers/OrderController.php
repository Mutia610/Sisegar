<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Customer;
use App\Models\StatusOrder;
use App\Models\OrderDetail;
use App\Models\Item;
use App\Models\Delivery;
use Validator;
use Storage;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        // $filterKeyword = $request->get('keyword');

        // $data['order'] = Order::join('deliveries', 'id_order','id')
        //                 ->join('users', 'users.id', 'orders.id_user')
        //                 ->select('orders.id', 'orders.updated_at', 'no_resi', 'users.name', 'total_harga','ongkir', 'pajak','total_bayar')
        //                 ->where([['status', '=', "Diterima"]])
        //                 ->orderBy('orders.created_at', 'DESC')
        //                 ->paginate(10);

        
        // if ($filterKeyword) {
        //     $data = Order::join('users', 'users.id', 'orders.id_user')
        //              ->select('orders.id', 'orders.updated_at', 'users.name', 'total_harga','ongkir', 'pajak','total_bayar')
        //              ->where('orders.id', 'LIKE', "%$filterKeyword%")
        //              ->whereBetween('orders.created_at', [$tgl1, $tgl2])->paginate(5);
        // }

        $tgl1 = $request->tgl1;
        $tgl2 = $request->tgl2;
        
        $data = Order::join('deliveries', 'id_order','id')
                    ->join('users', 'users.id', 'orders.id_user')
                    ->select('orders.id', 'orders.updated_at', 'no_resi', 'users.name', 'total_harga','ongkir', 'pajak','total_bayar')
                    ->where([['status', '=', "Diterima"]])
                    ->whereBetween('orders.created_at', [$tgl1, $tgl2])
                    ->orderBy('orders.created_at', 'DESC')
                    ->paginate(10);
                    

        return view('order.index', compact('data', 'tgl1', 'tgl2'));
    }

    public function indexMenungguKonfirmasi(Request $request)
    {
        $filterKeyword = $request->get('keyword');

        $data['order'] = Order::where('status', '=', "Belum Bayar")
                        ->orWhere('status', '=', "Menunggu Konfirmasi")
                        ->orderBy('orders.created_at', 'DESC')
                        ->paginate(10);
        
        if ($filterKeyword) {
            $data['order'] = Order::where('id', 'LIKE', "%$filterKeyword%")->paginate(5);
        }
        
        return view('order.indexMenungguKonfirmasi', $data);
    }

    public function indexMasuk(Request $request)
    {
        $filterKeyword = $request->get('keyword');
        $id = Auth::user()->id;

        $data['order'] = Order::where([
                                ['status', '=', "Dikemas"],
                                ['id_user', '=', $id]
                            ])
                        ->orWhere([
                                ['status', '=', "Pembayaran Valid"],
                                ['id_user', '=', $id]
                            ])
                        ->orderBy('orders.created_at', 'DESC')
                        ->paginate(10);

        // $data['order'] = Order::where('status',"Dikemas")
        // ->orWhere('status',"Belum Bayar")
        // ->orderBy('created_at', 'DESC')
        // ->paginate(10);
        
        if ($filterKeyword) {
            $data['order'] = Order::where('id', 'LIKE', "%$filterKeyword%")->paginate(5);
        }
        
        return view('order.indexMasuk', $data);
    }

    public function indexDikirim(Request $request)
    {
        $filterKeyword = $request->get('keyword');
        $id = Auth::user()->id;

        // $data['order'] = Order::where('status',"Dikirim")
        // ->orderBy('created_at', 'DESC')
        // ->paginate(10);
        
        $data['order'] = Order::join('deliveries', 'id_order','id')
                        ->select('orders.id', 'orders.created_at', 'deliveries.created_at as tgl_kirim', 'no_resi','id', 'orders.id_user', 'orders.id_customer', 'nama', 'alamat', 'total_harga', 'kurir', 'waktu_pengiriman', 'ongkir', 'pajak', 'total_bayar', 'metode_pembayaran', 'status')
                        ->where([
                                ['status', '=', "Dikirim"],
                                ['orders.id_user', '=', $id]
                            ])
                            ->orderBy('orders.created_at', 'DESC')
                            ->paginate(10);


        if ($filterKeyword) {
            $data['order'] = Order::where('id', 'LIKE', "%$filterKeyword%")->paginate(5);
        }
        
        return view('order.indexDikirim', $data);
    }

    public function indexDiterima(Request $request)
    {
        $filterKeyword = $request->get('keyword');
        $id = Auth::user()->id;

        $data['order'] = Order::join('deliveries', 'id_order','id')
                        ->select('orders.id', 'orders.created_at', 'no_resi', 'nama', 'total_bayar', 'metode_pembayaran', 'status')
                        ->where([
                                ['status', '=', "Diterima"],
                                ['orders.id_user', '=', $id]
                            ])
                            ->orderBy('orders.created_at', 'DESC')
                            ->paginate(10);

        if ($filterKeyword) {
            $data['order'] = Order::where('id', 'LIKE', "%$filterKeyword%")->paginate(5);
        }
        
        return view('order.indexDiterima', $data);
    }

    public function indexDibatalkan(Request $request)
    {
        $filterKeyword = $request->get('keyword');
        $id = Auth::user()->id;

        // $data['order'] = Order::where('status',"Dibatalkan")
        // ->orderBy('created_at', 'DESC')
        // ->paginate(10);

        $data['order'] = Order::where([
                                ['status', '=', "Dibatalkan"],
                                ['id_user', '=', $id]
                            ])
                            ->orderBy('orders.created_at', 'DESC')
                            ->paginate(10);
        
        if ($filterKeyword) {
            $data['order'] = Order::where('id', 'LIKE', "%$filterKeyword%")->paginate(5);
        }
        
        return view('order.indexDibatalkan', $data);
    }

    public function indexDibatalkanAdmin(Request $request)
    {
        $filterKeyword = $request->get('keyword');

        // $data['order'] = Order::where('status',"Dibatalkan")
        // ->orderBy('created_at', 'DESC')
        // ->paginate(10);

        $data['order'] = Order::where([
                                ['status', '=', "Dibatalkan"]
                            ])
                            ->orderBy('orders.created_at', 'DESC')
                            ->paginate(10);
        
        if ($filterKeyword) {
            $data['order'] = Order::where('id', 'LIKE', "%$filterKeyword%")->paginate(5);
        }
        
        return view('order.indexDibatalkanAdmin', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $data['order'] = Order::findOrFail($id);
        return view('order.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'no_resi' => 'required|unique:deliveries',
            'id_order' => 'required',
            'id_customer' => 'required',
            'id_user' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input = $request->all();
        $dataOrder = Order::findOrFail($input['id_order']);

        Delivery::create($input);
        $dataOrder->update(['status' => 'Dikirim']);

        return redirect()->route('pesananMasuk')->with('status', 'Order Successfully Updated');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showMasuk($id)
    {
        $data['order'] = Order::findOrFail($id);
        
        $data['bukti'] = Db::table('payment_confirmations')
                    ->select('nominal_transfer', 'bukti_bayar')            
                    ->where('id_order', $id)
                    ->first();

        $idCustomer = $data['order']->id_customer;
        $data['customer'] = Customer::findOrFail($idCustomer);

        $data['order_detail'] = OrderDetail::join('items', 'id_product', 'items.id')
                                ->join('units', 'items.id_satuan', 'units.id')
                                ->where('id_order', $id)->paginate(5);

        return view('order.showMasuk', $data);
    }

    public function showMenungguKonfirmasi($id)
    {
        $data['order'] = Order::findOrFail($id);
        
        $data['bukti'] = Db::table('payment_confirmations')
                    ->select('nominal_transfer', 'bukti_bayar')            
                    ->where('id_order', $id)
                    ->first();

        $idCustomer = $data['order']->id_customer;
        $data['customer'] = Customer::findOrFail($idCustomer);

        $data['order_detail'] = OrderDetail::join('items', 'id_product', 'items.id')
                                ->join('units', 'items.id_satuan', 'units.id')
                                ->where('id_order', $id)->paginate(5);

        return view('order.showMenungguKonfirmasi', $data);
    }

    public function showDikirim($id)
    {
        $data['order'] = Order::findOrFail($id);

        $data['bukti'] = Db::table('payment_confirmations')
                    ->select('nominal_transfer', 'bukti_bayar')            
                    ->where('id_order', $id)
                    ->first();

        $idCustomer = $data['order']->id_customer;
        $data['customer'] = Customer::findOrFail($idCustomer);

        $data['delivery'] = Delivery::where('id_order', $id)->first();

        $data['order_detail'] = OrderDetail::join('items', 'id_product', 'items.id')
                                ->join('units', 'items.id_satuan', 'units.id')
                                ->where('id_order', $id)->paginate(5);

        return view('order.showDikirim', $data);
    }

    public function showDiterima($id)
    {
        $data['order'] = Order::findOrFail($id);

        $data['bukti'] = Db::table('payment_confirmations')
                    ->select('nominal_transfer', 'bukti_bayar')            
                    ->where('id_order', $id)
                    ->first();
                    
        $idCustomer = $data['order']->id_customer;
        $data['customer'] = Customer::findOrFail($idCustomer);

        $data['delivery'] = Delivery::where('id_order', $id)->first();

        $data['order_detail'] = OrderDetail::join('items', 'id_product', 'items.id')
                                ->join('units', 'items.id_satuan', 'units.id')
                                ->where('id_order', $id)->paginate(5);

        return view('order.showDiterima', $data);
    }

    public function showDibatalkan($id)
    {
        $data['order'] = Order::findOrFail($id);
                
        $data['bukti'] = Db::table('payment_confirmations')
                    ->select('nominal_transfer', 'bukti_bayar')            
                    ->where('id_order', $id)
                    ->first();

        $idCustomer = $data['order']->id_customer;
        $data['customer'] = Customer::findOrFail($idCustomer);

        $data['order_detail'] = OrderDetail::join('items', 'id_product', 'items.id')
                                ->join('units', 'items.id_satuan', 'units.id')
                                ->where('id_order', $id)->paginate(5);

        return view('order.showDibatalkan', $data);
    }

    public function showDibatalkanAdmin($id)
    {
        $data['order'] = Order::findOrFail($id);
                
        $data['bukti'] = Db::table('payment_confirmations')
                    ->select('nominal_transfer', 'bukti_bayar')            
                    ->where('id_order', $id)
                    ->first();

        $idCustomer = $data['order']->id_customer;
        $data['customer'] = Customer::findOrFail($idCustomer);

        $data['order_detail'] = OrderDetail::join('items', 'id_product', 'items.id')
                                ->join('units', 'items.id_satuan', 'units.id')
                                ->where('id_order', $id)->paginate(5);

        return view('order.showDibatalkanAdmin', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['order'] = Order::findOrFail($id);

        $data['statusOrder'] = StatusOrder::all();
        return view('order.edit', $data);
    }

    public function editPenjual($id)
    {
        $data['order'] = Order::findOrFail($id);

        $data['statusOrder'] = StatusOrder::all();
        return view('order.editPenjual', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dataOrder = Order::findOrFail($id);

        $input = $request->all();

        $dataOrder->update($input);
        return redirect()->route('pesananMasukAdmin')->with('status', 'Order Successfully Updated');
    }

    public function updatePenjual(Request $request, $id)
    {
        $dataOrder = Order::findOrFail($id);
        $input = $request->all();

        $dataOrder->update($input);
        return redirect()->route('pesananMasuk')->with('status', 'Order Successfully Updated');
    }

    public function updateDikirim($id)
    {
        $dataOrder = Order::findOrFail($id);

        $dataOrder->update(['status' => 'Diterima']);
        return redirect()->route('pesananDikirim')->with('status', 'Order Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function search(){
        
    }
}
