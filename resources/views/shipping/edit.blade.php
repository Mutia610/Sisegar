@extends('layouts.beranda')
@section('title')
Update Ongkos Kirim
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3>Update Ongkos Kirim</h3>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('shipping.update',[$shipping->id]) }}" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="card-body">

                        <div class="form-group">
                            <label for="id_user">ID User</label>
                            <input type="text" class="form-control" disabled id="id_user" nama="id_user" value="{{ Auth::user()->id }}" />
                        </div>

                        <div class="form-group">
                            <label for="kota">Kota</label>
                            <select class="form-control" name="kota" id="kota">
                                @foreach($kota as $row)
                                <option value="{{ $row->kota }}" @if($shipping->kota == $row->kota) selected @endif>{{ $row->kota }}</option>
                                @endforeach
                            </select>
                            <span class="error invalid-feedback">{{$errors->first('kota')}}</span>
                        </div>

                        <div class="form-group">
                            <label for="biaya">Biaya</label>
                            <input type="text" value="{{ $shipping->biaya }}" class="form-control {{ $errors->first('biaya') ? 'is-invalid':'' }}" name="biaya" id="biaya" />
                            <span class="error invalid-feedback">{{$errors->first('biaya')}}</span>
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