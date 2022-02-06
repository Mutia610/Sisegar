@extends('layouts.beranda')
@section('title')
Shipping Page
@endsection

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card card-primary">
        <div class="card-header">
            <h3>Kurir Yang Telah Tersedia</h3>
        </div>
        <div class="card-body table-responsive">
            <!-- @include('alert.success')

            @if(Request::get('keyword'))
              <a href="{{ route('shipping.index') }}" class="btn btn-success">Back</a>
            @else
              <a href="{{ route('shipping.create') }}" class="btn btn-primary">Create</a>
            @endif

            <hr />
            <form method="get" action="{{ route('shipping.index')  }}">
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
            <br /> -->
            <hr />

            <table class="table table-bordered">
	        	<thead>
                <tr>
                    <th>No</th>
                    <th>Ekspedisi</th>
                    <th>Tipe Pengiriman</th>
                    <th>Logo</th>
                </tr>
	        	</thead>
                <tbody>
                <!-- @foreach($shipping as $row)
                <tr>
                <td>{{ $loop->iteration + ($shipping->perPage() * ($shipping->currentPage() - 1)  )  }}</td>
                    <td>{{ $row->kota }}</td>
                    <td>{{ $row->biaya }}</td>
                    <td>
                      <a href="{{ route('shipping.edit',[$row->id]) }}" class="btn btn-info btn-sm" >Edit</a>
                      <form class="d-inline" action="{{ route('shipping.destroy',[$row->id]) }}" method="post" onsubmit="return confirm('Delete This Item ?')">
                          @csrf
                          {{ method_field('DELETE') }}
                         <input type="submit" class="btn btn-danger btn-sm" value="Delete" />
                       </form>
                    </td>
                </tr>
                @endforeach -->

                <tr>
                    <td>1</td>
                    <td>JNE (Jalur Nugraha Ekakurir)</td>
                    <td>- REG (LayananReguler)  <br />
                        - YES (Yakin Esok Sampai) <br />
                        - OKE (Ongkos Kirim Ekonomis) <br />
                        - SPS (Super Speed)
                    </td>
                    <td><img class="img-thumbnail" src="{{ asset('uploads/ekspedisi/jne.png') }}" width="150px" /></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>POS Indonesia</td>
                    <td>- Paket Kilat Khusus <br />
                        - Express Next Day Barang
                    </td>
                    <td><img class="img-thumbnail" src="{{ asset('uploads/ekspedisi/pos.png') }}" width="150px" /></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>TIKI (Citra Van Titipan Kilat)</td>
                    <td>- REG (Reguler Service) <br />
                        - ECO (Economy Service) <br />
                        - ONS (Over Night Service)
                    </td>
                    <td><img class="img-thumbnail" src="{{ asset('uploads/ekspedisi/tiki.png') }}" width="150px" /></td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $shipping->appends(Request::all())->links() }}
        </div>
      </div>
    </div>
  </div>
@endsection