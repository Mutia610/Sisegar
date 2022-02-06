@extends('layouts.beranda')
@section('title')
Products Page
@endsection

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card card-primary">
        <div class="card-header">
            <h3>List Products</h3>
        </div>
        <div class="card-body table-responsive">
            @include('alert.success')

            @if(Request::get('keyword'))
              <a href="{{ route('product.index') }}" class="btn btn-success">Back</a>
            @else
              <a href="{{ route('product.create') }}" class="btn btn-primary">Create</a>
            @endif

            <hr />
            <form method="get" action="{{ route('product.index')  }}">
              <div class="row">
                <div class="col-2">
                  <b>Search Name</b>
                </div>

              <div class="col-6">
                  <input type="text" class="form-control" value="{{ Request::get('keyword') }}" id="keyword" name="keyword">
              </div>

              <div class="col-3">
                  <select class="form-control" name="id_kategori" id="id_kategori">
                      @foreach($category as $row)
                          <option value="{{ $row->id }}">{{ $row->nama_kategori }}</option>
                      @endforeach
                   </select>
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
                    <th>Kategori</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Satuan</th>
                    <th>Stok</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>
	        	</thead>
                <tbody>
                @foreach($product as $row)
                <tr>
                <td>{{ $loop->iteration + ($product->perPage() * ($product->currentPage() - 1)  )  }}</td>
                    <td>{{ $row->id_kategori }}</td>
                    <td>{{ $row->nama }}</td>
                    <td>{{ $row->harga }}</td>
                    <td>{{ $row->satuan }}</td>
                    <td>{{ $row->stok }}</td>
                    <td><img class="img-thumbnail" src="{{ asset('uploads/'.$row->gambar) }}" width="150px" /></td>
                    <td>
                      <a href="{{ route('product.edit',[$row->id]) }}" class="btn btn-info btn-sm" >Edit</a>
                      <a href="{{ route('product.show',[$row->id]) }}" class="btn btn-warning btn-sm">Show</a>
                      <form class="d-inline" action="{{ route('product.destroy',[$row->id]) }}" method="post" onsubmit="return confirm('Delete This Item ?')">
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
            {{ $product->appends(Request::all())->links() }}
        </div>
      </div>
    </div>
  </div>
@endsection