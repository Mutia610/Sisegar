@extends('layouts.beranda')
@section('title')
Edit Customer
@endsection

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card card-primary">
        <div class="card-header">
            <h3>Edit Customer</h3>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('customer.update',[$customer->id]) }}" enctype="multipart/form-data">
            @csrf
            {{ method_field('PUT') }}

                <div class="card-body">
                  <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control {{$errors->first('username') ? 'is-invalid' : ''}}" name="username" id="username" placeholder="Enter username" value="{{ $customer->username }}">
                    <span class="error invalid-feedback">{{$errors->first('username')}}</span>
                  </div>

                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" disabled id="email" placeholder="Enter email" value="{{ $customer->email }}">
                  </div>
                  
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control {{$errors->first('password') ? 'is-invalid' : ''}}" name="password" id="password" placeholder="Enter password">
                    <span class="error invalid-feedback">{{$errors->first('password')}}</span>
                  </div>

                  <div class="form-group">
                        <label for="gender">Gender</label>
                        <select name="gender" id="gender" class="form-control  {{$errors->first('gender') ? 'is-invalid' : ''}}">
                            <option value="pria" @if($customer->gender == "pria") selected @endif >Pria</option>
                            <option value="wanita" @if($customer->gender == "wanita") selected @endif >Wanita</option>
                        </select>
                        <span class="error invalid-feedback">{{$errors->first('gender')}}</span>
                    </div>

                  <div class="form-group">
                    <label for="address">Alamat</label>
                    <textarea class="form-control {{$errors->first('address') ? 'is-invalid' : ''}}" name="address" id="address">{{ $customer->address }}</textarea>
                    <span class="error invalid-feedback">{{$errors->first('address')}}</span>
                  </div>

                  <div class="form-group">
                    <label for="phone">No HP</label>
                    <input type="text" class="form-control {{$errors->first('phone') ? 'is-invalid' : ''}}" name="phone" id="phone" placeholder="Enter no hp" value="{{ $customer->phone }}">
                    <span class="error invalid-feedback">{{$errors->first('phone')}}</span>
                  </div>

                  <div class="form-group">
                     <label for="foto">Foto</label>
                          <div class="input-group">
                               <img class="img-thumbnail" src="{{ asset('uploads/'.$customer->foto) }}" width="150px" />
                           </div>
                   </div>

                    <div class="form-group">
                        <label for="foto"></label>
                        <input type="file" class="form-control {{$errors->first('foto') ? 'is-invalid' : ''}}" name="foto" id="foto">
                        <span class="error invalid-feedback">{{$errors->first('foto')}}</span>
                    </div>
                
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
        </div>
      </div>
    </div>
  </div
@endsection