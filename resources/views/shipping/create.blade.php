@extends('layouts.beranda')
@section('title')
Create Ongkos Kirim
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3>Create Ongkos Kirim</h3>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('shipping.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">

                        <div class="form-group">
                            <label for="id_user">ID User</label>
                            <input type="text" value="{{ Auth::user()->id }}" class="form-control {{ $errors->first('id_user') ? 'is-invalid':'' }}" name="id_user" id="id_user" />
                            <span class="error invalid-feedback">{{$errors->first('id_user')}}</span>
                        </div>

                        <div class="form-group">
                            <label for="kota">Kota</label>
                            <select class="form-control" name="kota" id="kota">
                                @foreach($kota as $row)
                                <option value="{{ $row->kota }}">{{ $row->kota }}</option>
                                @endforeach
                            </select>
                            <span class="error invalid-feedback">{{$errors->first('kota')}}</span>
                        </div>

                        <div class="form-group">
                            <label for="biaya">Biaya</label>
                            <input type="text" value="{{ old('biaya') }}" class="form-control {{ $errors->first('biaya') ? 'is-invalid':'' }}" name="biaya" id="biaya" />
                            <span class="error invalid-feedback">{{$errors->first('biaya')}}</span>
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