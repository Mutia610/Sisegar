@extends('layouts.beranda')
@section('title')
Update Product
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3>Update Produk</h3>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('item.update',[$item->id]) }}" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="card-body">

                        <div class="form-group">
                            <label for="id_kategori">Kategori</label>
                            <select class="form-control" name="id_kategori" id="id_kategori">
                                @foreach($category as $row)
                                <option value="{{ $row->id }}" @if($item->id_kategori == $row->id) selected @endif>{{ $row->nama_kategori }}</option>
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
                            <input type="text" value="{{ $item->nama }}" class="form-control {{ $errors->first('nama') ? 'is-invalid':'' }}" name="nama" id="nama" />
                            <span class="error invalid-feedback">{{$errors->first('nama')}}</span>
                        </div>

                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" class="form-control {{ $errors->first('deskripsi') ? 'is-invalid':'' }}">{{ $item->deskripsi }}</textarea>
                            <span class="error invalid-feedback">{{$errors->first('deskripsi')}}</span>
                        </div>

                        <div class="form-group">
                            <label for="id_satuan">Satuan</label>
                            <select class="form-control" name="id_satuan" id="id_satuan">
                                @foreach($unit as $row)
                                <option value="{{ $row->id }}" @if($item->id_satuan == $row->id) selected @endif>{{ $row->satuan }}</option>
                                @endforeach
                            </select>
                            <span class="error invalid-feedback">{{$errors->first('id_satuan')}}</span>
                        </div>

                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input type="text" value="{{ $item->harga }}" class="form-control {{ $errors->first('harga') ? 'is-invalid':'' }}" name="harga" id="harga" />
                            <span class="error invalid-feedback">{{$errors->first('harga')}}</span>
                        </div>

                        <div class="form-group">
                            <label for="stok">Stok</label>
                            <select name="stok" id="stok" class="form-control  {{$errors->first('stok') ? 'is-invalid' : ''}}">
                                <option value="tersedia" @if($item->stok == "tersedia") selected @endif >Tersedia</option>
                                <option value="habis" @if($item->stok == "habis") selected @endif >Habis</option>
                            </select>
                            <span class="error invalid-feedback">{{$errors->first('stok')}}</span>
                        </div>
 
                        <div class="form-group">
                            <label for="batas_pengiriman">Batas Pengiriman (Hari)</label>
                            <input type="text" value="{{ $item->batas_pengiriman }}" class="form-control {{ $errors->first('batas_pengiriman') ? 'is-invalid':'' }}" name="batas_pengiriman" id="batas_pengiriman"/>
                            <span class="error invalid-feedback">{{$errors->first('batas_pengiriman')}}</span>
                            <p>* Isi tanda - jika tidak ada batas pengiriman</p>
                        </div>

                        <div class="form-group">
                            <label for="gambar_item">Gambar</label>
                            <div class="input-group">
                                <img class="img-gambar_item" src="{{ asset('uploads/'.$item->gambar_item) }}" width="150px" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="gambar_item"></label>
                            <input type="file" class="form-control {{ $errors->first('gambar_item') ? 'is-invalid':'' }}" name="gambar_item" id="gambar_item" />
                            <span class="error invalid-feedback">{{$errors->first('gambar_item')}}</span>
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