@extends('layouts.beranda')
@section('title')
Order Page
@endsection

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card card-primary">
        <div class="card-header">
            <h3>List Pesanan Masuk</h3>
        </div>
        <div class="card-body table-responsive">
            @include('alert.success')

            @if(Request::get('keyword'))
              <a href="{{ route('pesananMasuk') }}" class="btn btn-success">Back</a>
            @endif

            <hr />
            <form method="get" action="{{ route('pesananMasuk')  }}">
              <div class="row">
                <div class="col-2">
                  <b>Search Name</b>
                </div>

              <div class="col-6">
                  <input type="text" class="form-control" value="{{ Request::get('keyword') }}" id="keyword" name="keyword">
              </div>

              <div class="col-1">
                  <button type="submit" class="btn btn-default">
                      <i class="fas fa-search"></i>
                  </button>
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
                    <th>No Pesanan</th>
                    <th>Nama</th>
                    <th>Total Pembayaran</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
	        	</thead>
                <tbody>
                @foreach($order as $row)
                <tr>
                <td>{{ $loop->iteration + ($order->perPage() * ($order->currentPage() - 1)  )  }}</td>
                    <td>{{ date('d-m-Y H:i:s', strtotime($row->created_at)) }}</td>
                    <td>{{ $row->id }}</td>
                    <td>{{ $row->nama }}</td>
                    <td>Rp.{{number_format($row->total_bayar)}}</td>
                    <td>{{ $row->status }}</td>
                    <td>
                      @if($row->status == "Dikemas")
                      <a href="{{ route('create',[$row->id]) }}" class="btn btn-info btn-sm" >Edit</a>
                      @else
                      <a href="{{ route('editPenjual',[$row->id]) }}" class="btn btn-info btn-sm" >Edit</a>
                      @endif
                      <a href="{{ route('showMasuk',[$row->id]) }}" class="btn btn-warning btn-sm">Show</a>
                      </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $order->appends(Request::all())->links() }}
        </div>
      </div>
    </div>
  </div>
@endsection