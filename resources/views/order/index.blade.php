@extends('layouts.beranda')
@section('title')
Order Page
@endsection

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card card-primary">
        <div class="card-header">
            <h3>List Pesanan Selesai</h3>
        </div>
        <div class="card-body table-responsive">
            @include('alert.success')

            <form method="get" action="{{ route('order.index')  }}">
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
                    <button type="submit" class="btn btn-info">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
              </div>
            </form>

            <!-- @if(Request::get('keyword'))
              <a href="{{ route('order.index') }}" class="btn btn-success">Back</a>
            @endif

            <hr />
            <form method="get" action="{{ route('order.index')  }}">
              <div class="row">
                <div class="col-2">
                  <b>Cari No Pesanan</b>
                </div>

              <div class="col-6">
                  <input type="text" class="form-control" value="{{ Request::get('keyword') }}" id="keyword" name="keyword">
              </div>

              <div class="col-1">
                  <button type="submit" class="btn btn-default">
                      <i class="fas fa-search"></i>
                  </button>
              </div>
            </form> -->

            <br />
            <br />
            <hr />

            <table class="table table-bordered">
	        	<thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal Diterima</th>
                    <th>Nama Penjual</th>
                    <th>No Pesanan</th>
                    <th>Harga Beli</th>
                    <th>Ongkir</th>
                    <th>Biaya Admin</th>
                    <th>Total Bayar</th>
                </tr>
	        	</thead>
                <tbody>
                @foreach($data as $row)
                <tr>
                <td>{{ $loop->iteration + ($data->perPage() * ($data->currentPage() - 1)  )  }}</td>
                    <td>{{ date('d-m-Y', strtotime($row->updated_at)) }}</td>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->id }}</td>
                    <td>Rp.{{ number_format($row->total_harga) }}</td>
                    <td>Rp.{{ number_format($row->ongkir) }}</td>
                    <td>Rp.{{ number_format($row->pajak) }}</td>
                    <td>Rp.{{ number_format($row->total_bayar) }}</td>
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