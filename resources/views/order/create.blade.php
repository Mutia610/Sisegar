@extends('layouts.beranda')
@section('title')
Edit Pesanan
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3>Edit Pesanan</h3>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('order.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">

                        <div class="form-group">
                            <label for="id_order">No Pesanan</label>
                            <input type="text"value="{{ $order->id }}" class="form-control {{ $errors->first('id_order') ? 'is-invalid':'' }}" name="id_order" id="id_order"/>
                            <span class="error invalid-feedback">{{$errors->first('id_order')}}</span>
                        </div>

                        <div class="form-group">
                            <label for="no_resi">No Resi</label>
                            <input type="text" value="{{ old('no_resi') }}" class="form-control {{ $errors->first('no_resi') ? 'is-invalid':'' }}" name="no_resi" id="no_resi" placeholder="Input no_resi"/>
                            <span class="error invalid-feedback">{{$errors->first('no_resi')}}</span>
                        </div>

                        <div class="form-group">
                            <!-- <label for="id_user">ID Seller</label> -->
                            <input type="hidden" value="{{ Auth::user()->id }}" class="form-control {{ $errors->first('id_user') ? 'is-invalid':'' }}" name="id_user" id="id_user"/>
                            <span class="error invalid-feedback">{{$errors->first('id_user')}}</span>
                        </div>

                        <div class="form-group">
                            <!-- <label for="id_customer">ID Customer</label> -->
                            <input type="hidden" value="{{ $order->id_customer }}" class="form-control {{ $errors->first('id_customer') ? 'is-invalid':'' }}" name="id_customer" id="id_customer"/>
                            <span class="error invalid-feedback">{{$errors->first('id_customer')}}</span>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection