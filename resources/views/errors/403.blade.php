@extends('layouts.beranda')
@section('title')
Error 403
@endsection

@section('content')
<div class="error-page">
    <h2 class="headline text-danger">403</h2>
    <div class="error-content">
        <h3><i class="fas fa-exclamation-triangle text-danger"></i>You don't have permission to access / on this Menu</h3>
        <a href="{{ route('home') }}" class="btn btn-info">Back</a>
    </div>
</div>
@endsection