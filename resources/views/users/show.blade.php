@extends('layouts.beranda')
@section('title')
Detail User - {{ $users->name }}
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3>Detail User - {{ $users->name }}</h3>
            </div>
            <div class="card-body table-responsive">
                <a href="{{ route('users.index') }}" class="btn btn-info">Back</a>
                <hr />
                <table class="table table-bordered">
                    <tr>
                        <td>Tanggal Input</td>
                        <td>:</td>
                        <td>{{ $users->created_at }}</td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td>{{ $users->name }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td>{{ $users->email }}</td>
                    </tr>
                    <tr>
                        <td>Level</td>
                        <td>:</td>
                        <td>{{ $users->level }}</td>
                    </tr> 
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>:</td>
                        <td>{{ $users->gender }}</td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td>{{ $users->address }}</td>
                    </tr>
                    <tr>
                        <td>No HP</td>
                        <td>:</td>
                        <td>{{ $users->phone }}</td>
                    </tr>
                    <tr>
                        <td>Foto</td>
                        <td>:</td>
                        <td><img class="img-thumbnail" src="{{ asset('uploads/'.$users->avatar) }}" width="150" /></td>
                    </tr>
                </table>
            </div>
            <div class="card-footer">
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3>Rekening - {{ $users->name }}</h3>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered">
                <hr />
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Bank</th>
                            <th>No Rekening</th>
                            <th>Atas Nama</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bank as $row)
                        <tr>
                            <td>{{ $loop->iteration + ($bank->perPage() * ($bank->currentPage() - 1)  )  }}</td>
                            <td>{{ $row->bank }}</td>
                            <td>{{ $row->no_rekening }}</td>
                            <td>{{ $row->atas_nama }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
            </div>
        </div>
    </div>
</div>
@endsection