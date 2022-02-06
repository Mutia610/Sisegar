@extends('layouts.beranda')
@section('title')
Edit Kategori
@endsection

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card card-primary">
        <div class="card-header">
            <h3>Edit Kategori</h3>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('category.update',[$category->id]) }}" enctype="multipart/form-data">
            @csrf
            {{ method_field('PUT') }}

                <div class="form-group">
                    <label for="nama_kategori">Nama Kategori</label>
                    <input type="text" class="form-control {{$errors->first('nama_kategori') ? 'is-invalid' : ''}}" name="nama_kategori" id="nama_kategori" placeholder="Enter nama kategori" value="{{ $category->nama_kategori }}">
                    <span class="error invalid-feedback">{{$errors->first('nama_kategori')}}</span>
                </div>

                <div class="form-group">
                     <label for="gambar">Gambar</label>
                          <div class="input-group">
                               <img class="img-thumbnail" src="{{ asset('uploads/'.$category->gambar) }}" width="150px" />
                           </div>
                </div>

                <div class="form-group">
                    <label for="gambar"></label>
                    <input type="file" class="form-control {{$errors->first('gambar') ? 'is-invalid' : ''}}" name="gambar" id="gambar">
                    <span class="error invalid-feedback">{{$errors->first('gambar')}}</span>
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