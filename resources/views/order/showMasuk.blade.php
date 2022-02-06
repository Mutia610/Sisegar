@extends('layouts.beranda')
@section('title')
Detail Pesanan - {{ $order->id }}
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3>Detail Pesanan - {{ $order->id }}</h3>
            </div>
            <div class="card-body table-responsive">
                <a href="{{ route('pesananMasuk') }}" class="btn btn-info">Back</a>
                <hr />
                <table class="table table-bordered">
                    <tr>
                        <td>Tanggal Pemesanan</td>
                        <td>:</td>
                        <td>{{ $order->created_at }}</td>
                    </tr>
                    <tr>
                        <td>No Pesanan</td>
                        <td>:</td>
                        <td>{{ $order->id }}</td>
                    </tr>
                    <tr>
                        <td>Nama Customer</td>
                        <td>:</td>
                        <td>{{ $customer->username }}</td>
                    </tr>
                    <tr>
                        <td>No HP Customer</td>
                        <td>:</td>
                        <td>{{ $customer->phone }}</td>
                    </tr>
                    <tr>
                        <td>Alamat Customer</td>
                        <td>:</td>
                        <td>{{ $order->alamat }}</td>
                    </tr>
                    <tr>
                        <td>Kurir</td>
                        <td>:</td>
                        <td>{{ $order->kurir }}</td>
                    </tr>
                    <tr>
                        <td>Ongkos Kirim</td>
                        <td>:</td>
                        <td>Rp.{{number_format($order->ongkir)}}</td>
                    </tr>
                    <tr>
                        <td>Total Harga Pembelian Produk</td>
                        <td>:</td>
                        <td>Rp.{{number_format($order->total_harga)}}</td>
                    </tr>
                    <tr>
                        <td>Biaya Admin</td>
                        <td>:</td>
                        <td>Rp.{{number_format($order->pajak)}}</td>
                    </tr>
                    <tr>
                        <td>Total Pembayaran</td>
                        <td>:</td>
                        <td>Rp.{{number_format($order->total_bayar)}}</td>
                    </tr>
                    <tr>
                        <td>Metode Pembayaran</td>
                        <td>:</td>
                        <td>{{ $order->metode_pembayaran }}</td>
                    </tr>
                    
                    @if(empty($bukti->bukti_bayar))
                        <tr>
                            <td>Bukti Transfer</td>
                            <td>:</td>
                            <td>-</td>
                        </tr>
                    @else
                        <tr>
                            <td>Bukti Transfer</td>
                            <td>:</td>
                            <td><img class="img-thumbnail" src="{{ asset('uploads/'.$bukti->bukti_bayar) }}" width="150px" /></td>
                        </tr>
                    @endif
                    
                    <tr>
                        <td>Status Pesanan</td>
                        <td>:</td>
                        <td>{{ $order->status }}</td>
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
                <h3>Detail Produk - {{ $order->id }}</h3>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered">
                <hr />
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Gambar</th>
                            <th>Jumlah Beli</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order_detail as $row)
                        <tr>
                            <td>{{ $loop->iteration + ($order_detail->perPage() * ($order_detail->currentPage() - 1)  )  }}</td>
                            <td>{{ $row->nama }}</td>
                            <td><img class="img-thumbnail" src="{{ asset('uploads/'.$row->gambar_item) }}" width="150px" /></td>
                            <td>{{ $row->jumlah}} {{$row->satuan}}</td>
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