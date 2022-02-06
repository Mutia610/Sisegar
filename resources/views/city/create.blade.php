@extends('layouts.beranda')
@section('title')
Create Kota
@endsection

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card card-primary">
        <div class="card-header">
            <h3>Create Kota</h3>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('city.store') }}" enctype="multipart/form-data">
            @csrf
               <div class="form-group">
                    <label for="id_raja_ongkir">ID Raja Ongkir</label>
                    <input type="text" class="form-control {{$errors->first('id_raja_ongkir') ? 'is-invalid' : ''}}" name="id_raja_ongkir" id="id_raja_ongkir" placeholder="Enter id raja ongkir" value="{{ old('id_raja_ongkir') }}">
                    <span class="error invalid-feedback">{{$errors->first('id_raja_ongkir')}}</span>
                </div>

                <div class="form-group">
                    <label for="kota">Kota</label>
                    <input type="text" class="form-control {{$errors->first('kota') ? 'is-invalid' : ''}}" name="kota" id="kota" placeholder="Enter kota" value="{{ old('kota') }}">
                    <span class="error invalid-feedback">{{$errors->first('kota')}}</span>
                </div>

                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </form>
        </div>
      </div>
    </div>
  </div
@endsection