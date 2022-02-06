
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=2">
  <title>SISEGAR | Registration Page</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
</head>


<body>
  <br />
<div class="row">
    <div class="col-1"></div>
    <div class="col-10" >
      <div class="card card-success">
        <div class="card-header">
            <h3>Registrasi</h3>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control {{$errors->first('email') ? 'is-invalid' : ''}}" name="email" id="email" placeholder="Enter email" value="{{ old('email') }}">
                    <span class="error invalid-feedback">{{$errors->first('email')}}</span>
                  </div>
                  
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control {{$errors->first('password') ? 'is-invalid' : ''}}" name="password" id="password" placeholder="Enter password">
                    <span class="error invalid-feedback">{{$errors->first('password')}}</span>
                  </div>

                  <div class="form-group">
                    <label for="name">Nama Penjual</label>
                    <input type="text" class="form-control {{$errors->first('name') ? 'is-invalid' : ''}}" name="name" id="name" placeholder="Enter nama penjual" value="{{ old('name') }}">
                    <span class="error invalid-feedback">{{$errors->first('name')}}</span>
                  </div>

                  <div class="form-group">
                    <label for="level">Level</label>
                    <input type="text" class="form-control {{$errors->first('level') ? 'is-invalid' : ''}}" name="level" id="level" value="Seller">
                    <span class="error invalid-feedback">{{$errors->first('level')}}</span>
                  </div>

                  <div class="form-group">
                            <label for="gender">Jenis Kelamin</label>
                            <select name="gender" id="gender" class="form-control  {{$errors->first('gender') ? 'is-invalid' : ''}}">
                                <option value="pria">Pria</option>
                                <option value="wanita">Wanita</option>
                            </select>
                            <span class="error invalid-feedback">{{$errors->first('gender')}}</span>
                    </div>

                  <div class="form-group">
                    <label for="address">Alamat Toko</label>
                    <textarea class="form-control {{$errors->first('address') ? 'is-invalid' : ''}}" name="address" id="address">{{ old('address') }}</textarea>
                    <span class="error invalid-feedback">{{$errors->first('address')}}</span>
                  </div>

                  <div class="form-group">
                    <label for="phone">No HP</label>
                    <input type="text" class="form-control {{$errors->first('phone') ? 'is-invalid' : ''}}" name="phone" id="phone" placeholder="Enter no hp" value="{{ old('phone') }}">
                    <span class="error invalid-feedback">{{$errors->first('phone')}}</span>
                  </div>

                  <div class="form-group">
                      <label for="avatar">Foto</label>
                      <input type="file" class="form-control {{$errors->first('avatar') ? 'is-invalid' : ''}}" name="avatar" id="avatar">
                      <span class="error invalid-feedback">{{$errors->first('avatar')}}</span>
                  </div>

                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </form>
        </div>
      </div>
    </div>
    <div class="col-1"></div>
</div>
</body>
</html>
