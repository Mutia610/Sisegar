@extends('layouts.beranda')
@section('title')
Unit Page
@endsection

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card card-primary">
        <div class="card-header">
            <h3>Data Satuan</h3>
        </div>
        <div class="card-body table-responsive">
            @include('alert.success')

            <a href="{{ route('unit.create') }}" class="btn btn-primary">Create</a>

            <br />
            <hr />

            <table class="table table-bordered">
	        	<thead>
                <tr>
                    <th>No</th>
                    <th>Satuan</th>
                    <th>Aksi</th>
                </tr>
	        	</thead>
                <tbody>
                @foreach($unit as $row)
                <tr>
                   <td>{{ $loop->iteration + ($unit->perPage() * ($unit->currentPage() - 1)  )  }}</td>
                    <td>{{ $row->satuan }}</td>
                    <td>
                       <a href="{{ route('unit.edit',[$row->id]) }}" class="btn btn-info btn-sm" >Edit</a>
                       <form class="d-inline" action="{{ route('unit.destroy',[$row->id]) }}" method="post" onsubmit="return confirm('Delete This Item ?')">
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
            {{ $unit->appends(Request::all())->links() }}
        </div>
      </div>
    </div>
  </div>
@endsection