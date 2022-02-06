@extends('layouts.beranda')
@section('title')
Edit Image Slider
@endsection

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card card-primary">
        <div class="card-header">
            <h3>Edit Image Slider</h3>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('slider.update',[$slider->id]) }}" enctype="multipart/form-data">
            @csrf
            {{ method_field('PUT') }}

                <div class="form-group">
                     <label for="image">Gambar</label>
                          <div class="input-group">
                               <img class="img-thumbnail" src="{{ asset('uploads/'.$slider->image) }}" width="150px" />
                         </div>
                </div>

                <div class="form-group">
                    <label for="image"></label>
                    <input type="file" class="form-control {{$errors->first('image') ? 'is-invalid' : ''}}" name="image" id="image">
                    <span class="error invalid-feedback">{{$errors->first('image')}}</span>
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <input type="text" class="form-control {{$errors->first('deskripsi') ? 'is-invalid' : ''}}" name="deskripsi" id="deskripsi" placeholder="Enter deskripsi" value="{{ $slider->deskripsi }}">
                    <span class="error invalid-feedback">{{$errors->first('deskripsi')}}</span>
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