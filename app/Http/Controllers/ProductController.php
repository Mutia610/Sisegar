<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use App\Models\Unit;
use Validator;
use Storage;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // public function __construct()
    // {
    //     $this->middleware(function ($request, $next) {
    //         if (Gate::allows('manage-products')) return $next($request);
    //         abort(403);
    //     });
    // }

    public function index(Request $request)
    {
        $filterKeyword = $request->get('keyword');
        $filterLevel = $request->get('level');

        $data['product'] = Product::where('id_user', Auth::user()->id)->paginate(5);
        $data['category'] = Category::all();
        
        if ($filterKeyword) {
            $data['product'] = Product::where('nama', 'LIKE', "%$filterKeyword%")->paginate(5);
        }else if($filterLevel){
            $data['product'] = Product::where('level',$filterLevel)->paginate(5);
        }
        
        return view('product.index', $data); 
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
        return view('product.create', $data);
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
            'gambar' => 'required|image|mimes:jpeg,jpg,png,svg|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input = $request->all();
        if ($request->file('gambar')->isValid()) {
            $gambarFile = $request->file('gambar');
            $extention = $gambarFile->getClientOriginalExtension();
            $fileName = "product-gambar/" . date('YmdHis') . "." . $extention;
            $uploadPath = "public/uploads/product-gambar";
            $request->file('gambar')->move($uploadPath, $fileName);
            $input['gambar'] = $fileName;
        }

        Product::create($input);
        return redirect()->route('product.index')->with('status', 'Product Successfully Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['product'] = Product::findOrFail($id);
        return view('product.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['product'] = Product::findOrFail($id);
        $data['category'] = Category::all();
        $data['unit'] = Unit::all();
        $data['users'] = User::where('level', 'seller')->get();
        return view('product.edit', $data);
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
        $dataProduct = Product::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nama' => 'required|max:255',
            'deskripsi' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'gambar' => 'sometimes|nullable|image|mimes:jpeg,jpg,png,svg|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $input = $request->all();
        if ($request->hasFile('gambar')) {
            if ($request->file('gambar')->isValid()) {
                Storage::disk('upload')->delete($dataProduct->gambar);
                $gambarFile = $request->file('gambar');
                $extention = $gambarFile->getClientOriginalExtension();
                $fileName = "product-gambar/" . date('YmdHis') . "." . $extention;
                $uploadPath = "public/uploads/product-gambar";
                $request->file('gambar')->move($uploadPath, $fileName);
                $input['gambar'] = $fileName;
            }
        }

        $dataProduct->update($input);
        return redirect()->route('product.index')->with('status', 'Product Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dataProduct = Product::findOrFail($id);
        $dataProduct->delete();
        Storage::disk('upload')->delete($dataProduct->gambar);
        return redirect()->back()->with('status', 'Product Successfully Deleted');
    }
}
