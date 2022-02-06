@extends('layouts.beranda')
@section('title')
Home
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <h3>Dashboard</h3>
        <hr />
    </div>


    <div class="col-lg-4 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $seller }}</h3>
                <p>Total Penjual Di Aplikasi</p>
            </div>
            <div class="icon">
                <i class="fas fa-chalkboard-teacher"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-6">
        <div class="small-box bg-maroon">
            <div class="inner">
                <h3>{{ $customer }}</h3>
                <p>Total Pelanggan Di Aplikasi</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $order }}</h3>
                <p>Total Transaksi Di Aplikasi</p>
            </div>
            <div class="icon">
                <i class="fas fa-th-large"></i>
            </div>
        </div>
    </div>
</div>
@endsection