<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use Validator;
use Storage;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Gate;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // public function __construct()
    // {
    //     $this->middleware(function ($request, $next) {
    //         if (Gate::allows('manage-sliders')) return $next($request);
    //         abort(403);
    //     });
    // }

    public function index()
    {
        $data['slider'] = Slider::paginate(5);
        return view('slider.index', $data); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('slider.create');
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
            'image' => 'required|image|mimes:jpeg,jpg,png,svg|max:2048',
            'deskripsi' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input = $request->all();
        if ($request->file('image')->isValid()) {
            $imageFile = $request->file('image');
            $extention = $imageFile->getClientOriginalExtension();
            $fileName = "slider-image/" . date('YmdHis') . "." . $extention;
            $uploadPath = "uploads/slider-image";
            $request->file('image')->move($uploadPath, $fileName);
            $input['image'] = $fileName;
        }

        Slider::create($input);
        return redirect()->route('slider.index')->with('status', 'Image Slider Successfully Created');
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
        $data['slider'] = Slider::findOrFail($id);
        return view('slider.edit', $data);
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
        $dataSlider = Slider::findOrFail($id);

        $validator = validator::make($request->all(),[
            'image' => 'sometimes|nullable|image|mimes:jpeg,jpg,png,svg|max:2048',
            'deskripsi' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $input = $request->all();
        if($request->hasfile('image')){
            if($request->file('image')->isValid()){
                Storage::disk('upload')->delete($dataSlider->image);
                $imageFile = $request->file('image');
                $extention = $imageFile->getClientOriginalExtension();
                $fileName = "slider-image/" . date('YmdHis') . "." . $extention;
                $uploadPath = "uploads/slider-image";
                $request->file('image')->move($uploadPath, $fileName);
                $input['image'] = $fileName;
            }
        }

        $dataSlider->update($input);
        return redirect()->route('slider.index')->with('status', 'Image Slider Successfully Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dataSlider = Slider::findOrFail($id);
        $dataSlider->delete();
        return redirect()->back()->with('status', 'Image Slider Successfully Deleted');
    }
}
