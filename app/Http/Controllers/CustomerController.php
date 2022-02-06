<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Validator;
use Storage;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Gate;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // public function __construct()
    // {
    //     $this->middleware(function ($request, $next) {
    //         if (Gate::allows('manage-customers')) return $next($request);
    //         abort(403);
    //     });
    // }

    public function index(Request $request)
    {
        $filterKeyword = $request->get('keyword');
        $data['customer'] = Customer::paginate(5);
        if ($filterKeyword) {
            $data['customer'] = Customer::where('username', 'LIKE', "%$filterKeyword%")->paginate(5);
        }
        return view('customer.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer.create');
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
            'username' => 'required|max:255',
            'email' => 'required|email|max:255|unique:customers',
            'password' => 'required|min:6',
            'phone' => 'required|digits_between:10,12',
            'gender' => 'required',
            'address' => 'required|max:255',
            'foto' => 'required|image|mimes:jpeg,jpg,png,svg|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input = $request->all();
        if ($request->file('foto')->isValid()) {
            $fotoFile = $request->file('foto');
            $extention = $fotoFile->getClientOriginalExtension();
            $fileName = "customer-foto/" . date('YmdHis') . "." . $extention;
            $uploadPath = "uploads/customer-foto";
            $request->file('foto')->move($uploadPath, $fileName);
            $input['foto'] = $fileName;
        }

        $input['password'] = \Hash::make($request->get('password'));
        Customer::create($input);
        return redirect()->route('customer.index')->with('status', 'Customer Successfully Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['customer'] = Customer::findOrFail($id);
        return view('customer.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['customer'] = Customer::findOrFail($id);
        return view('customer.edit', $data);
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
        $dataCustomer = Customer::findOrFail($id);

        $validator = validator::make($request->all(),[
            'username' => 'required|max:255',
            'gender' => 'required',
            'address' => 'required|max:255',
            'phone' => 'required|digits_between:10,12',
            'foto' => 'sometimes|nullable|image|mimes:jpeg,jpg,png,svg|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $input = $request->all();
        if($request->hasfile('foto')){
            if($request->file('foto')->isValid()){
                Storage::disk('upload')->delete($dataCustomer->foto);
                $fotoFile = $request->file('foto');
                $extention = $fotoFile->getClientOriginalExtension();
                $fileName = "customer-foto/" . date('YmdHis') . "." . $extention;
                // $uploadPath = env('UPLOAD_PATH') . "/customer-foto";
                $uploadPath = "uploads/customer-foto";
                $request->file('foto')->move($uploadPath, $fileName);
                $input['foto'] = $fileName;
            }
        }

        if ($request->input('password')) {
            $input['password'] = \Hash::make($input['password']);
        } else {
            $input = Arr::except($input, ['password']);
        }

        $dataCustomer->update($input);
        return redirect()->route('customer.index')->with('status', 'Customer Successfully Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dataCustomer = Customer::findOrFail($id);
        $dataCustomer->delete();
        Storage::disk('upload')->delete($dataCustomer->foto);
        return redirect()->back()->with('status', 'Customer Successfully Deleted');
    }
    
}
