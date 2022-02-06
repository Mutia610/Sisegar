@extends('layouts.beranda')
@section('title')
Create Satuan Produk
@endsection

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card card-primary">
        <div class="card-header">
            <h3>Create Satuan Produk</h3>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('unit.store') }}" enctype="multipart/form-data">
            @csrf
                <div class="form-group">
                    <label for="satuan">Satuan</label>
                    <input type="text" class="form-control {{$errors->first('satuan') ? 'is-invalid' : ''}}" name="satuan" id="satuan" placeholder="Enter satuan" value="{{ old('satuan') }}">
                    <span class="error invalid-feedback">{{$errors->first('satuan')}}</span>
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