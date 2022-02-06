@extends('layouts.beranda')
@section('title')
Edit Status Pesanan
@endsection

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card card-primary">
        <div class="card-header">
            <h3>Edit Status Pesanan</h3>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('statusOrder.update',[$statusOrder->id]) }}" enctype="multipart/form-data">
            @csrf
            {{ method_field('PUT') }}

                <div class="form-group">
                    <label for="status">Status Pesanan</label>
                    <input type="text" class="form-control {{$errors->first('status') ? 'is-invalid' : ''}}" name="status" id="status" placeholder="Enter status Pesanan" value="{{ $statusOrder->status }}">
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
  </div
@endsection