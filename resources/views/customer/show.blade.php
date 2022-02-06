@extends('layouts.beranda')
@section('title')
Detail User - {{ $customer->username }}
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3>Detail User - {{ $customer->username }}</h3>
            </div>
            <div class="card-body table-responsive">
                <a href="{{ route('customer.index') }}" class="btn btn-info">Back</a>
                <hr />
                <table class="table table-bordered">
                    <tr>
                        <td>Tanggal Input</td>
                        <td>:</td>
                        <td>{{ $customer->created_at }}</td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td>{{ $customer->username }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td>{{ $customer->email }}</td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>:</td>
                        <td>{{ $customer->gender }}</td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td>{{ $customer->address }}</td>
                    </tr>
                    <tr>
                        <td>No HP</td>
                        <td>:</td>
                        <td>{{ $customer->phone }}</td>
                    </tr>
                    <tr>
                        <td>Foto</td>
                        <td>:</td>
                        <td><img class="img-thumbnail" src="{{ asset('uploads/'.$customer->foto) }}" width="150" /></td>
                    </tr>
                </table>
            </div>
            <div class="card-footer">
            </div>
        </div>
    </div>
</div>
@endsection