@extends('layouts.beranda')
@section('title')
Update Payment
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3>Update Pembayaran Toko</h3>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('shop_payment.update',[$shop->id]) }}" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="card-body">

                        <div class="form-group">
                            <label for="id_user">Nama Penjual</label>
                            <select class="form-control" name="id_user" id="id_user">
                                @foreach($user as $row)
                                <option value="{{ $row->id }}" @if($shop->id_user == $row->id) selected @endif>{{ $row->name }}</option>
                                @endforeach
                            </select>
                            <span class="error invalid-feedback">{{$errors->first('id_user')}}</span>
                        </div>


                        <div class="form-group">
                            <label for="no_rekening_penerima">Rekening Penerima</label>
                            <input type="text" value="{{ $shop->no_rekening_penerima }}" class="form-control {{ $errors->first('no_rekening_penerima') ? 'is-invalid':'' }}" name="no_rekening_penerima" id="no_rekening_penerima" />
                            <span class="error invalid-feedback">{{$errors->first('no_rekening_penerima')}}</span>
                        </div>

                        <div class="form-group">
                            <label for="no_rekening_pengirim">Rekening Pengirim</label>
                            <input type="text" value="{{ $shop->no_rekening_pengirim }}" class="form-control {{ $errors->first('no_rekening_pengirim') ? 'is-invalid':'' }}" name="no_rekening_pengirim" id="no_rekening_pengirim" />
                            <span class="error invalid-feedback">{{$errors->first('no_rekening_pengirim')}}</span>
                        </div>


                        <div class="form-group">
                            <label for="jumlah_transfer">Jumlah Transfer</label>
                            <input type="text" value="{{ $shop->jumlah_transfer }}" class="form-control {{ $errors->first('jumlah_transfer') ? 'is-invalid':'' }}" name="jumlah_transfer" id="jumlah_transfer" />
                            <span class="error invalid-feedback">{{$errors->first('jumlah_transfer')}}</span>
                        </div>

                        <div class="form-group">
                            <label for="bukti_transfer">Bukti Transfer</label>
                            <div class="input-group">
                                <img class="img-thumbnail" src="{{ asset('uploads/'.$shop->bukti_transfer) }}" width="150px" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="bukti_transfer"></label>
                            <input type="file" class="form-control {{ $errors->first('bukti_transfer') ? 'is-invalid':'' }}" name="bukti_transfer" id="bukti_transfer" />
                            <span class="error invalid-feedback">{{$errors->first('bukti_transfer')}}</span>
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