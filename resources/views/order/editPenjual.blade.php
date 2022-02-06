@extends('layouts.beranda')
@section('title')
Update Status Pesanan
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3>Update Status Pesanan</h3>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('updatePenjual',[$order->id]) }}" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="card-body">

                        <div class="card-body">
                            <div class="form-group">
                            <label for="id">No Pesanan</label>
                            <input type="text" class="form-control" disabled id="id" value="{{ $order->id }}">
                        </div>

                        <!-- <div class="form-group">
                            <label for="status">Status Pesanan</label>
                            <select class="form-control" name="status" id="status">
                                @foreach($statusOrder as $row)
                                <option value="{{ $row->status }}" @if($order->status == $row->status) selected @endif>{{ $row->status }}</option>
                                @endforeach
                            </select>
                            <span class="error invalid-feedback">{{$errors->first('status')}}</span>
                        </div> -->

                        <div class="form-group">
                            <label for="status">Status Pesanan</label>
                            <select name="status" id="status" class="form-control  {{$errors->first('status') ? 'is-invalid' : ''}}">
                                <option value="Dikemas">Dikemas</option>
                                <option value="Dibatalkan">Dibatalkan</option>
                            </select>
                            <span class="error invalid-feedback">{{$errors->first('status')}}</span>
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