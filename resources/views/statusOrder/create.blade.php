@extends('layouts.beranda')
@section('title')
Create Status Pesanan
@endsection

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card card-primary">
        <div class="card-header">
            <h3>Create Status Pesanan</h3>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('statusOrder.store') }}" enctype="multipart/form-data">
            @csrf
                <div class="form-group">
                    <label for="status">Status Pesanan</label>
                    <input type="text" class="form-control {{$errors->first('status') ? 'is-invalid' : ''}}" name="status" id="status" placeholder="Enter Status Pesanan" value="{{ old('status') }}">
                    <span class="error invalid-feedback">{{$errors->first('status')}}</span>
                </div>

                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </form>
        </div>
      </div>
    </div>
  </div
@endsection