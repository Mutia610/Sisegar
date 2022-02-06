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

    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $product }}</h3>
                <p>Produk</p>
            </div>
            <div class="icon">
                <i class="fas fa-list-alt"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-maroon">
            <div class="inner">
                <h3>{{ $pesanan_masuk }}</h3>
                <p>Pesanan Masuk</p>
            </div>
            <div class="icon">
                <i class="fas fa-cart-arrow-down"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $pesanan_dikirim }}</h3>
                <p>Pesanan Dikirim</p>
            </div>
            <div class="icon">
                <i class="fas fa-truck"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-purple">
            <div class="inner">
                <h3>{{ $pesanan_diterima }}</h3>
                <p>Pesanan Diterima</p>
            </div>
            <div class="icon">
                <i class="fas fa-gift"></i>
            </div>
        </div>
    </div>
</div>
@endsection