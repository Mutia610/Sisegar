@extends('layouts.beranda')
@section('title')
Create Bank Account
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3>Create Bank Account</h3>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('bank_account.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">

                        <div class="form-group">
                            <label for="id_user">ID User</label>
                            <input type="text" value="{{ Auth::user()->id }}" class="form-control {{ $errors->first('id_user') ? 'is-invalid':'' }}" name="id_user" id="id_user" />
                            <span class="error invalid-feedback">{{$errors->first('id_user')}}</span>
                        </div>

                        <div class="form-group">
                            <label for="bank">Bank</label>
                            <input type="text" value="{{ old('bank') }}" class="form-control {{ $errors->first('bank') ? 'is-invalid':'' }}" name="bank" id="bank" />
                            <span class="error invalid-feedback">{{$errors->first('bank')}}</span>
                        </div>

                        <div class="form-group">
                            <label for="no_rekening">No Rekening</label>
                            <input type="text" value="{{ old('no_rekening') }}" class="form-control {{ $errors->first('no_rekening') ? 'is-invalid':'' }}" name="no_rekening" id="no_rekening" />
                            <span class="error invalid-feedback">{{$errors->first('no_rekening')}}</span>
                        </div>

                        <div class="form-group">
                            <label for="atas_nama">Atas Nama</label>
                            <input type="text" value="{{ old('atas_nama') }}" class="form-control {{ $errors->first('atas_nama') ? 'is-invalid':'' }}" name="atas_nama" id="atas_nama" />
                            <span class="error invalid-feedback">{{$errors->first('atas_nama')}}</span>
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