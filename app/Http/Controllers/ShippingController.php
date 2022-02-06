<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shipping;
use App\Models\City;
use Validator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // public function __construct()
    // {
    //     $this->middleware(function ($request, $next) {
    //         if (Gate::allows('manage-ongkir')) return $next($request);
    //         abort(403);
    //     });
    // }

    
    public function index(Request $request)
    {
        $filterKeyword = $request->get('keyword');
        $data['shipping'] = Shipping::where('id_user', Auth::user()->id)->paginate(5);
        $data['kota'] = City::all();

        if ($filterKeyword) {
            $data['shipping'] = Shipping::where('kota', 'LIKE', "%$filterKeyword%")->paginate(5);
        }
        return view('shipping.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['kota'] = City::all();
        return view('shipping.create', $data);
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
            'id_user' => 'required',
            'biaya' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input = $request->all();
        Shipping::create($input);
        return redirect()->route('shipping.index')->with('status', 'Shipping Successfully Created');
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
        $data['shipping'] = Shipping::findOrFail($id);
        $data['kota'] = City::all();
        return view('shipping.edit', $data);
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
        $dataShipping = Shipping::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'kota' => 'required',
            'biaya' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $input = $request->all();

        $dataShipping->update($input);
        return redirect()->route('shipping.index')->with('status', 'Shipping Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dataShipping = Shipping::findOrFail($id);
        $dataShipping->delete();
        return redirect()->back()->with('status', 'Shipping Successfully Deleted');
    }
}
