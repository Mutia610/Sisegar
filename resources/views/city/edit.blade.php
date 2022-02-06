@extends('layouts.beranda')
@section('title')
Edit Kota
@endsection

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card card-primary">
        <div class="card-header">
            <h3>Edit Kota</h3>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('city.update',[$city->id]) }}" enctype="multipart/form-data">
            @csrf
            {{ method_field('PUT') }}

                <div class="form-group">
                    <label for="id_raja_ongkir">ID Raja Ongkir</label>
                    <input type="text" class="form-control" disabled id="id_raja_ongkir" placeholder="Enter id_raja_ongkir" value="{{ $city->id_raja_ongkir }}">
                  </div>

                <div class="form-group">
                    <label for="kota">Kota</label>
                    <input type="text" class="form-control {{$errors->first('kota') ? 'is-invalid' : ''}}" name="kota" id="kota" placeholder="Enter kota" value="{{ $city->kota }}">
                    <span class="error invalid-feedback">{{$errors->first('kota')}}</span>
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