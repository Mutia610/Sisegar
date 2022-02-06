<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Validator;
use Storage;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Gate::allows('manage-categories')) return $next($request);
            abort(403);
        });
    }

    public function index(Request $request)
    {
        $filterKeyword = $request->get('keyword');
        $data['category'] = Category::paginate(5);
        if ($filterKeyword) {
            $data['category'] = Category::where('nama_kategori', 'LIKE', "%$filterKeyword%")->paginate(5);
        }
        return view('category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
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
            'nama_kategori' => 'required|max:255',
            'gambar' => 'required|image|mimes:jpeg,jpg,png,svg|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input = $request->all();
        if ($request->file('gambar')->isValid()) {
            $gambarFile = $request->file('gambar');
            $extention = $gambarFile->getClientOriginalExtension();
            $fileName = "kategori-gambar/" . date('YmdHis') . "." . $extention;
            $uploadPath = "uploads/kategori-gambar";
            $request->file('gambar')->move($uploadPath, $fileName);
            $input['gambar'] = $fileName;
        }

        Category::create($input);
        return redirect()->route('category.index')->with('status', 'Category Successfully Created');
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
        $data['category'] = Category::findOrFail($id);
        return view('category.edit', $data);
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
        $dataCategory = Category::findOrFail($id);

        $validator = validator::make($request->all(),[
            'nama_kategori' => 'required|max:255',
            'gambar' => 'sometimes|nullable|image|mimes:jpeg,jpg,png,svg|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $input = $request->all();
        if($request->hasfile('gambar')){
            if($request->file('gambar')->isValid()){
                Storage::disk('upload')->delete($dataCategory->gambar);
                $gambarFile = $request->file('gambar');
                $extention = $gambarFile->getClientOriginalExtension();
                $fileName = "kategori-gambar/" . date('YmdHis') . "." . $extention;
                $uploadPath = "uploads/kategori-gambar";
                $request->file('gambar')->move($uploadPath, $fileName);
                $input['gambar'] = $fileName;
            }
        }

        $dataCategory->update($input);
        return redirect()->route('category.index')->with('status', 'Category Successfully Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dataCategory = Category::findOrFail($id);
        $dataCategory->delete();
        return redirect()->back()->with('status', 'Category Successfully Deleted');
    }
}
