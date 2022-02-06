@extends('layouts.beranda')
@section('title')
City Page
@endsection

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card card-primary">
        <div class="card-header">
            <h3>Data Kota</h3>
        </div>
        <div class="card-body table-responsive">
            @include('alert.success')

            <a href="{{ route('city.create') }}" class="btn btn-primary">Create</a>

            <br />
            <hr />

            <table class="table table-bordered">
	        	<thead>
                <tr>
                    <th>No</th>
                    <th>ID Raja Ongkir</th>
                    <th>Kota</th>
                    <th>Aksi</th>
                </tr>
	        	</thead>
                <tbody>
                @foreach($city as $row)
                <tr>
                   <td>{{ $loop->iteration + ($city->perPage() * ($city->currentPage() - 1)  )  }}</td>
                    <td>{{ $row->id_raja_ongkir }}</td>
                    <td>{{ $row->kota }}</td>
                    <td>
                       <a href="{{ route('city.edit',[$row->id]) }}" class="btn btn-info btn-sm" >Edit</a>
                       <form class="d-inline" action="{{ route('city.destroy',[$row->id]) }}" method="post" onsubmit="return confirm('Delete This Item ?')">
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
            {{ $city->appends(Request::all())->links() }}
        </div>
      </div>
    </div>
  </div>
@endsection