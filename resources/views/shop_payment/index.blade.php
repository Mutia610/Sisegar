@extends('layouts.beranda')
@section('title')
Shop Payment Page
@endsection

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card card-primary">
        <div class="card-header">
            <h3>List Pembayaran Penjual</h3>
        </div>
        <div class="card-body table-responsive">
            @include('alert.success')


            @if(Request::get('keyword'))
              <a href="{{ route('shop_payment.index') }}" class="btn btn-success">Back</a>
            @else
              <a href="{{ route('shop_payment.create') }}" class="btn btn-primary">Create</a>
            @endif

            <br />
            <br />
            <hr />

            <form method="get" action="{{ route('shop_payment.index')  }}">
              <div class="row">
                <div class="col-5">
                    <label for="admin">Start Date</label>
                    <input class="form-control" type="date" value="{{$tgl1}}" name="tgl1">
                </div>

                <div class="col-5">
                    <label for="admin">End Date</label>
                    <input class="form-control" type="date" value="{{$tgl2}}" name="tgl2">
                </div>                           
                
                <div class="col-2 pt-2">
                  <br />
                    <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
              </div>
            </form>
            
            <form class="form-group" action="{{ route('cetakPDF') }}" method="GET" enctype="multipart/form-data" style="float: right">
              @csrf
              <div class="form-group">
                   <input hidden="" class="form-control" type="date" value="{{$tgl1}}" name="tgl1">
              </div>
               <div class="form-group">
                   <input hidden="" class="form-control" type="date" value="{{$tgl2}}" name="tgl2">
               </div>                            
               <div class="text">
                   <button type="submit" class="btn btn-success">Cetak</button>
               </div>
            </form>

            <br />
            <br />
            <br />
            <hr />

            <table class="table table-bordered">
	        	<thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Nama Penjual</th>
                    <th>Rekening Penerima</th>
                    <th>Rekening Pengirim</th>
                    <th>Jumlah Transfer</th>
                    <th>Bukti</th>
                    <th>Aksi</th>
                </tr>
	        	</thead>
                <tbody>
                @foreach($data as $row)
                <tr>
                <td>{{ $loop->iteration + ($data->perPage() * ($data->currentPage() - 1)  )  }}</td>
                    <td>{{ date('d-m-Y', strtotime($row->created_at)) }}</td>
                    <td>{{ $row->user->name }}</td>
                    <td>{{ $row->no_rekening_penerima }}</td>
                    <td>{{ $row->no_rekening_pengirim }}</td>
                    <td>Rp.{{number_format($row->jumlah_transfer)}}</td>
                    <td><img class="img-thumbnail" src="{{ asset('uploads/'.$row->bukti_transfer) }}" width="100px" /></td>
                    <td>
                      <a href="{{ route('shop_payment.edit',[$row->id]) }}" class="btn btn-info btn-sm" >Edit</a>
                      <form class="d-inline" action="{{ route('shop_payment.destroy',[$row->id]) }}" method="post" onsubmit="return confirm('Delete This Item ?')">
                            @csrf
                            {{ method_field('DELETE') }}
                            <input type="submit" class="btn btn-danger btn-sm" value="Delete" />
                       </form>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $data->appends(Request::all())->links() }}
        </div>
      </div>
    </div>
  </div>
@endsection