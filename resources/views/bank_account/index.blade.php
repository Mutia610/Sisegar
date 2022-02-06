@extends('layouts.beranda')
@section('title')
Bank Account Page
@endsection

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card card-primary">
        <div class="card-header">
            <h3>Data Rekening</h3>
        </div>
        <div class="card-body table-responsive">
            @include('alert.success')

            @if(Request::get('keyword'))
              <a href="{{ route('bank_account.index') }}" class="btn btn-success">Back</a>
            @else
              <a href="{{ route('bank_account.create') }}" class="btn btn-primary">Create</a>
            @endif

            <hr />
            <form method="get" action="{{ route('bank_account.index')  }}">
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
                    <th>Nama Bank</th>
                    <th>No Rekening</th>
                    <th>Atas Nama</th>
                    <th>Aksi</th>
                </tr>
	        	</thead>
                <tbody>
                @foreach($bank_account as $row)
                <tr>
                <td>{{ $loop->iteration + ($bank_account->perPage() * ($bank_account->currentPage() - 1)  )  }}</td>
                    <td>{{ $row->bank }}</td>
                    <td>{{ $row->no_rekening }}</td>
                    <td>{{ $row->atas_nama }}</td>
                    <td>
                      <a href="{{ route('bank_account.edit',[$row->id]) }}" class="btn btn-info btn-sm" >Edit</a>
                      <form class="d-inline" action="{{ route('bank_account.destroy',[$row->id]) }}" method="post" onsubmit="return confirm('Delete This Item ?')">
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
            {{ $bank_account->appends(Request::all())->links() }}
        </div>
      </div>
    </div>
  </div>
@endsection