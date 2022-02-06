<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Http\Resources\CustomerResource;
use Validator;
use Storage;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Gate;

class CustomerController extends Controller
{
    public function login(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'email' => 'required',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => FALSE,
                'msg' => $validator->errors()
            ], 400);
        }

        $email = $request->input('email');
        $password = $request->input('password');

        $customer = Customer::where('email', $email)->first();

        if (is_null($customer)) {
            return response()->json([
                'status' => FALSE,
                'msg' => 'Email & Password Tidak Sesuai'
            ], 200);
        } else {
            if (password_verify($password, $customer->password)) {
                //jika password sesuai
                return response()->json([
                    'status' => TRUE,
                    'msg' => 'User ditemukan',
                    'data' => new customerResource($customer)
                ], 200);
            } else {
                //jika password tidak sesuai
                return response()->json([
                    'status' => FALSE,
                    'msg' => 'Email & Password Tidak Sesuai'
                ], 200);
            }
        }
    }

    public function register(Request $request)
    {

        $apiKey = uniqid('customer_sisegar_8');

        $validator = validator::make($request->all(),[
            'username' => 'required|max:255',
            'email' => 'required|email|max:255|unique:customers',
            'password' => 'required|min:6',
            'phone' => 'required|digits_between:10,12',
            'gender' => 'required',
            'address' => 'required|max:255',
        ]);

        $input = $request->all();
        $input['api_key'] = $apiKey; 

        $fotoFile = $request->input('foto');
            
        $fileName = "customer-foto/" . date('YmdHis') . "." . "png";
        $uploadPath = env('UPLOAD_PATH') . "/customer-foto";
        $input['foto'] = $fileName;
    
        file_put_contents("public/uploads/". $fileName, base64_decode($fotoFile));

        $input['password'] = \Hash::make($request->get('password'));
        Customer::create($input);
        
        if ($input) {
            return response()->json([
                'success' => true,
                'message' => 'Registrasi Berhasil',
                'api_key' => $apiKey
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Registrasi Gagal',
            ], 401);
        }  
    }

    public function getCustomer(Request $request)
    {
        $id = $request->input('id');

        $data = Customer::where([['id', $id]])->get();

        if ($data->isEmpty()) {
            return response()->json([
                'status' => FALSE,
                'msg' => 'Produk Tidak ditemukan dengan kategori tersebut'
            ], 200);
        }

        return response()->json([
            "status" => TRUE,
            "data" => CustomerResource::collection($data)
        ]);
    }

    function updateCustomer(Request $request){

        $input = $request->all();
        $customer = Customer::find($request->get('id'));

        if (is_null($customer)) {
            return response()->json([
                'status' => FALSE,
                'msg' => 'Data tidak ditemukan'
            ], 404);
        }

        $customer->update($input);
        return response()->json([
            'status' => TRUE,
            'msg' => 'Data customer berhasil diupdate'
        ], 200);
    }

    function updateProfile(Request $request){

        $input = $request->all();
       
        $customer = Customer::find($request->get('id'));

        if (is_null($customer)) {
            return response()->json([
                'status' => FALSE,
                'msg' => 'Data tidak ditemukan'
            ], 404);
        }

        if ($request->input('password')) {
            $input['password'] = \Hash::make($input['password']);
        } else {
            $input = Arr::except($input, ['password']);
        }

        $customer->update($input);
        return response()->json([
            'status' => TRUE,
            'msg' => 'Data customer berhasil diupdate'
        ], 200);
    }


    public function updateFotoProfile(Request $request)
    {
        $input = $request->all();
        $dataCustomer = Customer::find($request->get('id'));

        if (is_null($dataCustomer)) {
            return response()->json([
                'status' => FALSE,
                'msg' => 'Data tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($input, [
            'foto' => 'sometimes|image|mimes:jpeg,jpg,png|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => FALSE,
                "msg" => $validator->errors()
            ], 400);
        }

        if($request->hasfile('foto')){
            if($request->file('foto')->isValid()){
                Storage::disk('upload')->delete($dataCustomer->foto);
                $fotoFile = $request->file('foto');
                $extention = $fotoFile->getClientOriginalExtension();
                $fileName = "customer-foto/" . date('YmdHis') . "." . $extention;
                $uploadPath = "public/uploads/customer-foto";
                $request->file('foto')->move($uploadPath, $fileName);
                $input['foto'] = $fileName;
            }
        }

        $dataCustomer->update($input);
        return response()->json([
            'status' => TRUE,
            'msg' => 'Foto Customer berhasil diupdate'
        ], 200);
    }

    public function getEmail(Request $request)
    {
        $email = $request->input('email');
        $data = Customer::select('id','email')->where('email', $email)->get();

        if ($data->isEmpty()) {
            return response()->json([
                'status' => FALSE,
                'msg' => 'Data Tidak ditemukan'
            ], 200);
        }

        return response()->json([
            "status" => TRUE,
            "data" => $data
        ]);
    }

    public function ubahPassword(Request $request)
    {
        $input = $request->all();
        $id = $request->input('id');
        $data = Customer::findOrFail($id);

        $password = \Hash::make($request->input('password'));

        // $data->update(['password' => $request->input('password')]);
        $data->update(['password' => $password]);

        return response()->json([
            "status" => TRUE,
            "data" => 'Password Berhasil Di Ubah'
        ]);
    }
}
