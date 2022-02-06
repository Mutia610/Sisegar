<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seller;
use Validator;
use Illuminate\Support\Arr;


class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     
    public function index(Request $request)
    {
        $filterKeyword = $request->get('keyword');

        $data['seller'] = Seller::paginate(5);
        
        if ($filterKeyword) {
            $data['seller'] = Seller::where('nama', 'LIKE', "%$filterKeyword%")->paginate(5);
        }
        
        return view('seller.index', $data);
    } 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('seller.create');
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
            'nama' => 'required',
            'nama_toko' => 'required',
            'deskripsi' => 'required',
            'kota' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input = $request->all();
        Seller::create($input);
        return redirect()->route('seller.index')->with('status', 'Seller Successfully Created');
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
        $data['seller'] = Seller::findOrFail($id);
        return view('seller.edit', $data);
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
        $dataSeller = Seller::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nama_toko' => 'required',
            'deskripsi' => 'required',
            'kota' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $input = $request->all();

        $dataSeller->update($input);
        return redirect()->route('seller.index')->with('status', 'Seller Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dataSeller = Seller::findOrFail($id);
        $dataSeller->delete();
        return redirect()->back()->with('status', 'Seller Successfully Deleted');
    }
}
