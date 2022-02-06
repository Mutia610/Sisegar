<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StatusOrder;
use Validator;
use Illuminate\Support\Facades\Gate;

class StatusOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['statusOrder'] = StatusOrder::paginate(5);
        return view('statusOrder.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('statusOrder.create');
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
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input = $request->all();

        StatusOrder::create($input);
        return redirect()->route('statusOrder.index')->with('status', 'Status Order Successfully Created');
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
        $data['statusOrder'] = StatusOrder::findOrFail($id);
        return view('statusOrder.edit', $data);
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
        $dataStatus = StatusOrder::findOrFail($id);

        $validator = validator::make($request->all(),[
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $input = $request->all();

        $dataStatus->update($input);
        return redirect()->route('statusOrder.index')->with('status', 'Status Order Successfully Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dataStatus = StatusOrder::findOrFail($id);
        $dataStatus->delete();
        return redirect()->back()->with('status', 'Status Order Successfully Deleted');
    }
}
