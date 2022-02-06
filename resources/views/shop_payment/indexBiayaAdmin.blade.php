@extends('layouts.beranda')
@section('title')
Biaya Admin
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <h4>Presentase Biaya Administrasi</h4>
        <hr />
    </div>

    <div class="col-12">
        <div class="small-box bg-danger ">
            <center>
                @foreach($data as $item)
                    <span style="font-style: bold; font-size: 100px;"><b>{{$item->presentase}}%</b></span><br/>
                @endforeach
                <span style="font-style: bold; font-size: 20px;">dari total harga pembelian oleh customer</span><br/>
            </center> 
            </br>
        </div>  
    
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalLong">Edit</button>
          
        <!-- Modal -->
        <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Edit Presentase Biaya Admin</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form method="post" action="{{ route('admin_fee.update','1') }}" enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PUT') }}
                
                        <div class="modal-body">
                            <label for="exampleFormControlInput1">Biaya Administrasi (%)</label>

                            @foreach($data as $item)
                                <input type="text" class="form-control" name="presentase" id="presentase" value="<?php echo $item['presentase'] ?>">
                            @endforeach
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection