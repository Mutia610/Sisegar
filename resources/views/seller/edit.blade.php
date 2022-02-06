@extends('layouts.beranda')
@section('title')
Edit Seller
@endsection

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card card-primary">
        <div class="card-header">
            <h3>Edit Seller</h3>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('seller.update',[$seller->id]) }}" enctype="multipart/form-data">
            @csrf
            {{ method_field('PUT') }}

                  <div class="form-group">
                        <label for="id_user">ID User</label>
                        <input type="text" class="form-control" disabled id="id_user" nama="id_user" value="{{ Auth::user()->id }}" />
                  </div>

                  <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" disabled id="nama" nama="nama" value="{{ Auth::user()->name }}" />
                  </div>

                  <div class="form-group">
                    <label for="nama_toko">Nama</label>
                    <input type="text" class="form-control {{$errors->first('nama_toko') ? 'is-invalid' : ''}}" name="nama_toko" id="nama_toko" placeholder="Enter nama" value="{{ $seller->nama_toko }}">
                    <span class="error invalid-feedback">{{$errors->first('nama_toko')}}</span>
                  </div>

                  <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea class="form-control {{$errors->first('deskripsi') ? 'is-invalid' : ''}}" name="deskripsi" id="deskripsi">{{ $seller->deskripsi }}</textarea>
                    <span class="error invalid-feedback">{{$errors->first('deskripsi')}}</span>
                  </div>

                  <div class="form-group">
                    <label for="kota">Kabupaten/Kota</label>
                    <input type="text" class="form-control {{$errors->first('kota') ? 'is-invalid' : ''}}" name="kota" id="kota" placeholder="Enter kota" value="{{ $seller->kota }}">
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