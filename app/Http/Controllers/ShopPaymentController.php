<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShopPayment;
use App\Models\User;
use App\Models\BankAccount;
use Validator;
use Storage;
use PDF;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;


class ShopPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        date_default_timezone_set("Asia/Jakarta");
        // $filterKeyword = $request->get('keyword');

        // $data['shop'] = ShopPayment::paginate(5);
        
        // if ($filterKeyword) {
        //     $data['shop'] = ShopPayment::where('name', 'LIKE', "%$filterKeyword%")->paginate(5);
        // }
        
        // return view('shop_payment.index', $data);

        $tgl1 = $request->tgl1;
        $tgl2 = $request->tgl2;
        $data = ShopPayment::whereBetween('created_at', [$tgl1, $tgl2])
                    ->paginate(10);

        return view('shop_payment.index', compact('data', 'tgl1', 'tgl2'));
    }

    public function indexPenjual(Request $request)
    {
        // $filterKeyword = $request->get('keyword');

        // $data['shop'] = ShopPayment::where('id_user', Auth::user()->id)->paginate(5);
        
        // if ($filterKeyword) {
        //     $data['shop'] = ShopPayment::where('name', 'LIKE', "%$filterKeyword%")->paginate(5);
        // }

        $tgl1 = $request->tgl1;
        $tgl2 = $request->tgl2;
        $data = ShopPayment::where('id_user', Auth::user()->id)
                    ->whereBetween('created_at', [$tgl1, $tgl2])
                    ->paginate(10);
        
        return view('shop_payment.indexPenjual', compact('data', 'tgl1', 'tgl2'));
    }

    public function indexBiayaAdmin(Request $request)
    {

        // return view('shop_payment.indexBiayaAdmin');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['user'] = User::where('level', 'seller')->get();

        // $id = $data['user']->first()->id;
        // $data['bank_account'] = BankAccount::all();
        $data['bank_account'] = BankAccount::where('id_user', '2')->get();

        return view('shop_payment.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = validator::make($request->all(),[
            'id_user' => 'required',
            'no_rekening_penerima' => 'required',
            'no_rekening_pengirim' => 'required',
            'jumlah_transfer' => 'required',
            'bukti_transfer' => 'required|image|mimes:jpeg,jpg,png|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input = $request->all();
        if ($request->file('bukti_transfer')->isValid()) {
            $gambarFile = $request->file('bukti_transfer');
            $extention = $gambarFile->getClientOriginalExtension();
            $fileName = "bukti-transfer/" . date('YmdHis') . "." . $extention;
            $uploadPath = "uploads/bukti-transfer";
            $request->file('bukti_transfer')->move($uploadPath, $fileName);
            $input['bukti_transfer'] = $fileName;
        }

        ShopPayment::create($input);
        return redirect()->route('shop_payment.index')->with('status', 'Shop Payment Successfully Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['shop'] = ShopPayment::findOrFail($id);
        $data['user'] = User::where('level', 'seller')->get();
        $data['bank_account'] = BankAccount::where('id_user', '2')->get();
        return view('shop_payment.edit', $data);
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
        $dataItem = ShopPayment::findOrFail($id);

        $validator = validator::make($request->all(),[
            'id_user' => 'required',
            'no_rekening_penerima' => 'required',
            'no_rekening_pengirim' => 'required',
            'jumlah_transfer' => 'required',
            'bukti_transfer' => 'sometimes|image|mimes:jpeg,jpg,png|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $input = $request->all();
        if ($request->hasFile('bukti_transfer')) {
            if ($request->file('bukti_transfer')->isValid()) {
                $gambarFile = $request->file('bukti_transfer');
                $extention = $gambarFile->getClientOriginalExtension();
                $fileName = "bukti-transfer/" . date('YmdHis') . "." . $extention;
                $uploadPath = "uploads/bukti-transfer";
                $request->file('bukti_transfer')->move($uploadPath, $fileName);
                $input['bukti_transfer'] = $fileName;
            }
        }

        $dataItem->update($input);
        return redirect()->route('shop_payment.index')->with('status', 'Data Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dataItem = ShopPayment::findOrFail($id);
        $dataItem->delete();
        Storage::disk('upload')->delete($dataItem->bukti_transfer);
        return redirect()->back()->with('status', 'Data Successfully Deleted');
    }

    public function cetakPDF(Request $request)
    {
        // $data = ShopPayment::all();
        $tgl1 = $request->tgl1;
        $tgl2 = $request->tgl2;
        $data = ShopPayment::whereBetween('created_at', [$tgl1, $tgl2])->get();
        $pdf = PDF::loadview('shop_payment.view',compact('data','tgl2', 'tgl1'))->setpaper('A4','potrait')->setOptions(['defaultFont' => 'sans-serif']);
        
        return $pdf->stream('Laporan_Pembayaran.pdf'); //download
    }

    public function cetakPdfPenjual(Request $request)
    {
        // $data = ShopPayment::where('id_user', Auth::user()->id)->get();
        $tgl1 = $request->tgl1;
        $tgl2 = $request->tgl2;
        $data = ShopPayment::where('id_user', Auth::user()->id)->whereBetween('created_at', [$tgl1, $tgl2])->get();
        $pdf = PDF::loadview('shop_payment.viewPenjual',compact('data','tgl2', 'tgl1'))->setpaper('A4','potrait')->setOptions(['defaultFont' => 'sans-serif']);
        
        return $pdf->stream('Laporan_Transfer_Penjual.pdf'); //download
    }
}
