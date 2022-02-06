@extends('layouts.beranda')
@section('title')
Category Page
@endsection

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card card-primary">
        <div class="card-header">
            <h3>Kategori Item</h3>
        </div>
        <div class="card-body table-responsive">
            @include('alert.success')

            @if(Request::get('keyword'))
              <a href="{{ route('category.index') }}" class="btn btn-success">Back</a>
            @else
              <a href="{{ route('category.create') }}" class="btn btn-primary">Create</a>
            @endif

            <hr />
            <form method="get" action="{{ route('category.index')  }}">
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
                    <th>Nama Kategori</th>
                    <th>Ikon</th>
                    <th>Aksi</th>
                </tr>
	        	</thead>
                <tbody>
                @foreach($category as $row)
                <tr>
                <td>{{ $loop->iteration + ($category->perPage() * ($category->currentPage() - 1)  )  }}</td>
                    <td>{{ $row->nama_kategori }}</td>
                    <td><img class="img-thumbnail" src="{{ asset('uploads/'.$row->gambar) }}" width="150px" /></td>
                    <td>
                       <a href="{{ route('category.edit',[$row->id]) }}" class="btn btn-info btn-sm" >Edit</a>
                       <form class="d-inline" action="{{ route('category.destroy',[$row->id]) }}" method="post" onsubmit="return confirm('Delete This Item ?')">
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
            {{ $category->appends(Request::all())->links() }}
        </div>
      </div>
    </div>
  </div>
@endsection