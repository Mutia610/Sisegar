@extends('layouts.beranda')
@section('title')
Detail Product - {{ $product->nama }}
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3>Detail Product - {{ $product->nama }}</h3>
            </div>
            <div class="card-body table-responsive">
                <a href="{{ route('product.index') }}" class="btn btn-info">Back</a>
                <hr />
                <table class="table table-bordered">
                    <tr>
                        <td>Tanggal Masuk</td>
                        <td>:</td>
                        <td>{{ $product->created_at }}</td>
                    </tr>
                    <tr>
                        <td>Nama Produk</td>
                        <td>:</td>
                        <td>{{ $product->nama }}</td>
                    </tr>
                    <tr>
                        <td>Kategori</td>
                        <td>:</td>
                        <td>{{ $product->id_kategori }}</td>
                    </tr>
                    <tr>
                        <td>Seller</td>
                        <td>:</td>
                        <td>{{ Auth::user()->name }}</td>
                    </tr> 
                    <tr>
                        <td>Deskripsi</td>
                        <td>:</td>
                        <td>{{ $product->deskripsi }}</td>
                    </tr>
                    <tr>
                        <td>Harga Jual</td>
                        <td>:</td>
                        <td>{{ $product->harga }}</td>
                    </tr>
                    <tr>
                        <td>Satuan Produk</td>
                        <td>:</td>
                        <td>{{ $product->satuan }}</td>
                    </tr>
                    <tr>
                        <td>Stok</td>
                        <td>:</td>
                        <td>{{ $product->stok }}</td>
                    </tr>
                    <tr>
                        <td>Gambar</td>
                        <td>:</td>
                        <td><img class="img-thumbnail" src="{{ asset('uploads/'.$product->gambar) }}" width="150" /></td>
                    </tr>
                </table>
            </div>
            <div class="card-footer">
            </div>
        </div>
    </div>
</div>
@endsection