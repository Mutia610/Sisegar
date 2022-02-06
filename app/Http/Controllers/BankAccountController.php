<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BankAccount;
use Validator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class BankAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // public function __construct()
    // {
    //     $this->middleware(function ($request, $next) {
    //         if (Gate::allows('manage-rekening')) return $next($request);
    //         abort(403);
    //     });
    // }

    public function index(Request $request)
    {
        $filterKeyword = $request->get('keyword');
        $data['bank_account'] = BankAccount::where('id_user', Auth::user()->id)->paginate(5);
        if ($filterKeyword) {
            $data['bank_account'] = BankAccount::where('bank', 'LIKE', "%$filterKeyword%")->paginate(5);
        }
        return view('bank_account.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bank_account.create');
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
            'bank' => 'required',
            'no_rekening' => 'required',
            'atas_nama' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input = $request->all();
        BankAccount::create($input);
        return redirect()->route('bank_account.index')->with('status', 'BankAccount Successfully Created');
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
        $data['bank_account'] = BankAccount::findOrFail($id);
        return view('bank_account.edit', $data);
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
        $dataBankAccount = BankAccount::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'bank' => 'required',
            'no_rekening' => 'required',
            'atas_nama' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $input = $request->all();

        $dataBankAccount->update($input);
        return redirect()->route('bank_account.index')->with('status', 'BankAccount Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dataBankAccount = BankAccount::findOrFail($id);
        $dataBankAccount->delete();
        return redirect()->back()->with('status', 'BankAccount Successfully Deleted');
    }
}
