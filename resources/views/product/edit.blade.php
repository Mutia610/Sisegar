@extends('layouts.beranda')
@section('title')
Update Product
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3>Update Product</h3>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('product.update',[$product->id]) }}" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="card-body">

                        <div class="form-group">
                            <label for="id_kategori">Kategori</label>
                            <select class="form-control" name="id_kategori" id="id_kategori">
                                @foreach($category as $row)
                                <option value="{{ $row->id }}" @if($product->id_kategori == $row->id) selected @endif>{{ $row->nama_kategori }}</option>
                                @endforeach
                            </select>
                            <span class="error invalid-feedback">{{$errors->first('id_kategori')}}</span>
                        </div>

                        <div class="form-group">
                            <label for="id_user">ID Seller</label>
                            <input type="text"value="{{ Auth::user()->id }}" class="form-control {{ $errors->first('id_user') ? 'is-invalid':'' }}" name="id_user" id="id_user" disabled/>
                            <span class="error invalid-feedback">{{$errors->first('id_user')}}</span>
                        </div>

                        <div class="form-group">
                            <label for="nama">Nama Produk</label>
                            <input type="text" value="{{ $product->nama }}" class="form-control {{ $errors->first('nama') ? 'is-invalid':'' }}" name="nama" id="nama" />
                            <span class="error invalid-feedback">{{$errors->first('nama')}}</span>
                        </div>

                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" class="form-control {{ $errors->first('deskripsi') ? 'is-invalid':'' }}">{{ $product->deskripsi }}</textarea>
                            <span class="error invalid-feedback">{{$errors->first('deskripsi')}}</span>
                        </div>

    
                        <div class="form-group">
                            <label for="id_satuan">Satuan</label>
                            <select class="form-control" name="id_satuan" id="id_satuan">
                                @foreach($unit as $row)
                                <option value="{{ $row->id }}" @if($product->id_satuan == $row->id) selected @endif>{{ $row->satuan }}</option>
                                @endforeach
                            </select>
                            <span class="error invalid-feedback">{{$errors->first('id_satuan')}}</span>
                        </div>

                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input type="text" value="{{ $product->harga }}" class="form-control {{ $errors->first('harga') ? 'is-invalid':'' }}" name="harga" id="harga" />
                            <span class="error invalid-feedback">{{$errors->first('harga')}}</span>
                        </div>
                        
                        <div class="form-group">
                            <label for="stok">Stok</label>
                            <select name="stok" id="stok" class="form-control  {{$errors->first('stok') ? 'is-invalid' : ''}}">
                                <option value="tersedia" @if($product->stok == "tersedia") selected @endif >Tersedia</option>
                                <option value="habis" @if($product->stok == "habis") selected @endif >Habis</option>
                            </select>
                            <span class="error invalid-feedback">{{$errors->first('stok')}}</span>
                        </div>
 
                        <div class="form-group">
                            <label for="gambar">Gambar</label>
                            <div class="input-group">
                                <img class="img-gambar" src="{{ asset('uploads/'.$product->gambar) }}" width="150px" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="gambar"></label>
                            <input type="file" class="form-control {{ $errors->first('gambar') ? 'is-invalid':'' }}" name="gambar" id="gambar" />
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
</div>
@endsection