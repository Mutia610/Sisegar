@extends('layouts.beranda')
@section('title')
Products Page
@endsection

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card card-primary">
        <div class="card-header">
            <h3>List Produk</h3>
        </div>
        <div class="card-body table-responsive">
            @include('alert.success')

            @if(Request::get('keyword'))
              <a href="{{ route('item.index') }}" class="btn btn-success">Back</a>
            @else
              <a href="{{ route('item.create') }}" class="btn btn-primary">Create</a>
            @endif

            <hr />
            <form method="get" action="{{ route('item.index')  }}">
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
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>
	        	</thead>
                <tbody>
                @foreach($item as $row)
                <tr>
                <td>{{ $loop->iteration + ($item->perPage() * ($item->currentPage() - 1)  )  }}</td>
                    <td>{{ $row->nama }}</td>
                    <td>Rp.{{number_format($row->harga) }}</td>
                    <td>{{ $row->stok }}</td>
                    <td><img class="img-thumbnail" src="{{ asset('uploads/'.$row->gambar_item) }}" width="150px" /></td>
                    <td>
                      <a href="{{ route('item.edit',[$row->id]) }}" class="btn btn-info btn-sm" >Edit</a>
                      <a href="{{ route('item.show',[$row->id]) }}" class="btn btn-warning btn-sm">Show</a>
                      <form class="d-inline" action="{{ route('item.destroy',[$row->id]) }}" method="post" onsubmit="return confirm('Delete This Item ?')">
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
            {{ $item->appends(Request::all())->links() }}
        </div>
      </div>
    </div>
  </div>
@endsection