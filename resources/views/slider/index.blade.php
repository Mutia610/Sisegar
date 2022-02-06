@extends('layouts.beranda')
@section('title')
Slider Page
@endsection

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card card-primary">
        <div class="card-header">
            <h3>Image Slider Data</h3>
        </div>
        <div class="card-body table-responsive">
            @include('alert.success')

            <a href="{{ route('slider.create') }}" class="btn btn-primary">Create</a>

            <br />
            <hr />

            <table class="table table-bordered">
	        	<thead>
                
                <tr>
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
	        	</thead>
                <tbody>
                @foreach($slider as $row)
                <tr>
                   <td>{{ $loop->iteration + ($slider->perPage() * ($slider->currentPage() - 1)  )  }}</td>
                    <td><img class="img-thumbnail" src="{{ asset('uploads/'.$row->image) }}" width="150px" /></td>
                    <td>{{ $row->deskripsi }}</td>
                    <td>
                       <a href="{{ route('slider.edit',[$row->id]) }}" class="btn btn-info btn-sm" >Edit</a>
                       <form class="d-inline" action="{{ route('slider.destroy',[$row->id]) }}" method="post" onsubmit="return confirm('Delete This Item ?')">
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
            {{ $slider->appends(Request::all())->links() }}
        </div>
      </div>
    </div>
  </div>
@endsection