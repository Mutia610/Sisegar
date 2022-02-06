@extends('layouts.beranda')
@section('title')
Customers Page
@endsection

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card card-primary">
        <div class="card-header">
            <h3>Data Customers</h3>
        </div>
        <div class="card-body table-responsive">
            @include('alert.success')

            @if(Request::get('keyword'))
              <a href="{{ route('customer.index') }}" class="btn btn-success">Back</a>
            @else
              <a href="{{ route('customer.create') }}" class="btn btn-primary">Create</a>
            @endif

            <hr />
            <form method="get" action="{{ route('customer.index')  }}">
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
                    <th>Username</th>
                    <th>Email</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>
	        	</thead>
                <tbody>
                @foreach($customer as $row)
                <tr>
                <td>{{ $loop->iteration + ($customer->perPage() * ($customer->currentPage() - 1)  )  }}</td>
                    <td>{{ $row->username }}</td>
                    <td>{{ $row->email }}</td>
                    <td><img class="img-thumbnail" src="{{ asset('uploads/'.$row->foto) }}" width="150px" /></td>
                    <td>
                      <a href="{{ route('customer.edit',[$row->id]) }}" class="btn btn-info btn-sm" >Edit</a>
                      <a href="{{ route('customer.show',[$row->id]) }}" class="btn btn-warning btn-sm">Show</a>
                      <form class="d-inline" action="{{ route('customer.destroy',[$row->id]) }}" method="post" onsubmit="return confirm('Delete This Item ?')">
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
            {{ $customer->appends(Request::all())->links() }}
        </div>
      </div>
    </div>
  </div>
@endsection