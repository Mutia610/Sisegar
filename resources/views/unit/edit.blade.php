@extends('layouts.beranda')
@section('title')
Edit Satuan
@endsection

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card card-primary">
        <div class="card-header">
            <h3>Edit Satuan</h3>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('unit.update',[$unit->id]) }}" enctype="multipart/form-data">
            @csrf
            {{ method_field('PUT') }}

                <div class="form-group">
                    <label for="satuan">Satuan</label>
                    <input type="text" class="form-control {{$errors->first('satuan') ? 'is-invalid' : ''}}" name="satuan" id="satuan" placeholder="Enter satuan" value="{{ $unit->satuan }}">
                    <span class="error invalid-feedback">{{$errors->first('satuan')}}</span>
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