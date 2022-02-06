@extends('layouts.beranda')
@section('title')
Create Seller
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3>Create Seller</h3>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('seller.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">

                       <!-- <div class="form-group">
                            <label for="id_user">ID User</label>
                            <input type="text" class="form-control" disabled id="id_user" nama="id_user" value="{{ Auth::user()->id }}" />
                        </div>

                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" disabled id="nama" nama="nama" value="{{ Auth::user()->name }}" />
                        </div> -->

                        <div class="form-group">
                            <label for="id_user">ID User</label>
                            <input type="text" value="{{ count($user)}}" class="form-control {{ $errors->first('id_user') ? 'is-invalid':'' }}" name="id_user" id="id_user" />
                            <span class="error invalid-feedback">{{$errors->first('id_user')}}</span>
                        </div>

                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" value="{{ old('nama') }}" class="form-control {{ $errors->first('nama') ? 'is-invalid':'' }}" name="nama" id="nama" />
                            <span class="error invalid-feedback">{{$errors->first('nama')}}</span>
                        </div>

                        <div class="form-group">
                            <label for="nama_toko">Nama Toko</label>
                            <input type="text" value="{{ old('nama_toko') }}" class="form-control {{ $errors->first('nama_toko') ? 'is-invalid':'' }}" name="nama_toko" id="nama_toko" />
                            <span class="error invalid-feedback">{{$errors->first('nama_toko')}}</span>
                        </div>

                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" class="form-control {{ $errors->first('deskripsi') ? 'is-invalid':'' }}">{{ old('deskripsi') }}</textarea>
                            <span class="error invalid-feedback">{{$errors->first('deskripsi')}}</span>
                        </div>

                        <div class="form-group">
                            <label for="kota">Kabupaten/Kota</label>
                            <input type="text" value="{{ old('kota') }}" class="form-control {{ $errors->first('kota') ? 'is-invalid':'' }}" name="kota" id="kota" />
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
</div>
@endsection