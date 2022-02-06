@extends('layouts.beranda')
@section('title')
Create Kategori
@endsection

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card card-primary">
        <div class="card-header">
            <h3>Create Kategori</h3>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('category.store') }}" enctype="multipart/form-data">
            @csrf
                  <div class="form-group">
                    <label for="nama_kategori">Nama Kategori</label>
                    <input type="text" class="form-control {{$errors->first('nama_kategori') ? 'is-invalid' : ''}}" name="nama_kategori" id="nama_kategori" placeholder="Enter nama_kategori" value="{{ old('nama_kategori') }}">
                    <span class="error invalid-feedback">{{$errors->first('nama_kategori')}}</span>
                  </div>

                  <div class="form-group">
                      <label for="gambar">Ikon</label>
                      <input type="file" class="form-control {{$errors->first('gambar') ? 'is-invalid' : ''}}" name="gambar" id="gambar">
                      <span class="error invalid-feedback">{{$errors->first('gambar')}}</span>
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