<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use App\Models\User;
use App\Models\Unit;
use Validator;
use Storage;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filterKeyword = $request->get('keyword');
        $filterLevel = $request->get('level');

        $data['item'] = Item::where('id_user', Auth::user()->id)->paginate(5);
        $data['category'] = Category::all();
        $data['unit'] = Unit::all();
        
        if ($filterKeyword) {
            $data['item'] = Item::where('nama', 'LIKE', "%$filterKeyword%")->paginate(5);
        }else if($filterLevel){
            $data['item'] = Item::where('level',$filterLevel)->paginate(5);
        }
        
        return view('item.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['users'] = User::where('level', 'seller')->get();
        $data['category'] = Category::all();
        $data['unit'] = Unit::all();
        return view('item.create', $data);
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
            'nama' => 'required|max:255',
            'deskripsi' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'batas_pengiriman' => 'required',
            'gambar_item' => 'required|image|mimes:jpeg,jpg,png,svg|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input = $request->all();
        if ($request->file('gambar_item')->isValid()) {
            $gambarFile = $request->file('gambar_item');
            $extention = $gambarFile->getClientOriginalExtension();
            $fileName = "product-gambar/" . date('YmdHis') . "." . $extention;
            $uploadPath = "uploads/product-gambar";
            $request->file('gambar_item')->move($uploadPath, $fileName);
            $input['gambar_item'] = $fileName;
        }

        Item::create($input);
        return redirect()->route('item.index')->with('status', 'Item Successfully Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['item'] = Item::findOrFail($id);
        return view('item.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['item'] = Item::findOrFail($id);
        $data['category'] = Category::all();
        $data['unit'] = Unit::all();
        $data['users'] = User::where('level', 'seller')->get();
        return view('item.edit', $data);
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
        $dataItem = Item::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nama' => 'required|max:255',
            'deskripsi' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'batas_pengiriman' => 'required',
            'gambar_item' => 'sometimes|nullable|image|mimes:jpeg,jpg,png,svg|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $input = $request->all();
        if ($request->hasFile('gambar_item')) {
            if ($request->file('gambar_item')->isValid()) {
                Storage::disk('upload')->delete($dataItem->gambar);
                $gambarFile = $request->file('gambar_item');
                $extention = $gambarFile->getClientOriginalExtension();
                $fileName = "product-gambar/" . date('YmdHis') . "." . $extention;
                $uploadPath = "uploads/product-gambar";
                $request->file('gambar_item')->move($uploadPath, $fileName);
                $input['gambar_item'] = $fileName;
            }
        }

        $dataItem->update($input);
        return redirect()->route('item.index')->with('status', 'Item Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dataItem = Item::findOrFail($id);
        $dataItem->delete();
        Storage::disk('upload')->delete($dataItem->gambar_item);
        return redirect()->back()->with('status', 'Item Successfully Deleted');
    }
}
