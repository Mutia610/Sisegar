@extends('layouts.beranda')
@section('title')
Edit Bank Account
@endsection

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card card-primary">
        <div class="card-header">
            <h3>Edit Bank Account</h3>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('bank_account.update',[$bank_account->id]) }}" enctype="multipart/form-data">
            @csrf
            {{ method_field('PUT') }}

                  <div class="form-group">
                        <label for="id_user">ID User</label>
                        <input type="text" class="form-control" disabled id="id_user" nama="id_user" value="{{ Auth::user()->id }}" />
                  </div>

                  <div class="form-group">
                    <label for="bank">Nama Bank</label>
                    <input type="text" class="form-control {{$errors->first('bank') ? 'is-invalid' : ''}}" name="bank" id="bank" placeholder="Enter nama bank" value="{{ $bank_account->bank }}">
                    <span class="error invalid-feedback">{{$errors->first('bank')}}</span>
                  </div>

                  <div class="form-group">
                    <label for="no_rekening">No Rekening</label>
                    <input type="text" class="form-control {{$errors->first('no_rekening') ? 'is-invalid' : ''}}" name="no_rekening" id="no_rekening" placeholder="Enter no rekening" value="{{ $bank_account->no_rekening }}">
                    <span class="error invalid-feedback">{{$errors->first('no_rekening')}}</span>
                  </div>

                  <div class="form-group">
                    <label for="atas_nama">Atas Nama</label>
                    <input type="text" class="form-control {{$errors->first('atas_nama') ? 'is-invalid' : ''}}" name="atas_nama" id="atas_nama" placeholder="Enter atas nama" value="{{ $bank_account->atas_nama }}">
                    <span class="error invalid-feedback">{{$errors->first('atas_nama')}}</span>
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