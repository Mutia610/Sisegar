@extends('layouts.beranda')
@section('title')
Shop Payment Page
@endsection

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card card-primary">
        <div class="card-header">
            <h3>List Transfer Penjualan</h3>
        </div>
        <div class="card-body table-responsive">
            @include('alert.success')

            <form method="get" action="{{ route('indexPenjual')  }}">
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
            <form class="form-group" action="{{ route('cetakPdfPenjual') }}" method="GET" enctype="multipart/form-data" style="float: right">
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
            <hr />

            <table class="table table-bordered">
	        	<thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Rek Penerima</th>
                    <th>Rek Pengirim</th>
                    <th>Jumlah</th>
                    <th>Bukti</th>
                </tr>
	        	</thead>
                <tbody>
                @foreach($data as $row)
                <tr>
                <td>{{ $loop->iteration + ($data->perPage() * ($data->currentPage() - 1)  )  }}</td>
                    <td>{{ date('d-m-Y', strtotime($row->created_at)) }}</td>
                    <td>{{ $row->no_rekening_penerima }}</td>
                    <td>{{ $row->no_rekening_pengirim }}</td>
                    <td>Rp.{{number_format($row->jumlah_transfer)}}</td>
                    <td><img class="img-thumbnail" src="{{ asset('uploads/'.$row->bukti_transfer) }}" width="100px" /></td>
                </tr>
                @endforeach
                <tr>
                  <td></td>
                  <td>
                  <b>	Total </b>
                  </td>
                  <td></td>
                  <td></td>
                  <td>
                    @php
                    $tot = 0;
                    @endphp							
                    @foreach($data as $index=>$x)	
                      @php							
                        $tot += $x->jumlah_transfer;
                      @endphp
                    @endforeach
                    <b> Rp.{{number_format($tot)}} </b>
                  </td>
                  <td></td>
						    </tr>
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