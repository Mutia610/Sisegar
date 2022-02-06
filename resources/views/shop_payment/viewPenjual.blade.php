<!DOCTYPE html>
<html>
    <head>
        <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
        <title>Laporan Transfer Dari Aplikasi</title>
    </head>
<body>
  <br><br>
  
  <div class="container">
    <center>
        <span style="font-style: bold; font-size: 20px;"><b>Laporan Transfer Dari Aplikasi</b></span><br/>
        <span style="font-size: 14px"> <b>{{date('d-m-Y', strtotime($tgl1))}}</b> s/d <b>{{date('d-m-Y', strtotime($tgl2))}}</b></span>
        <br/><br/><br/>
    </center>
    
    <br>
    <table border="1" cellpadding="10" style="width: 100%; border-collapse: collapse">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Rekening Penerima</th>
                <th>Rekening Pengirim</th>
                <th>Jumlah Transfer</th>
            </tr>
        </thead>
        <tbody>
            @php($i=1)
            @foreach($data as $row)
                <tr>
                    <td><b>{{ $i++ }}</b></td>
                    <td>{{ date('d-m-Y', strtotime($row->created_at)) }}</td>
                    <td>{{ $row->no_rekening_penerima }}</td>
                    <td>{{ $row->no_rekening_pengirim }}</td>
                    <td>Rp.{{number_format($row->jumlah_transfer)}}</td>
                </tr>
            @endforeach
           
        </tbody>
    </table>
  </div>
</body>
</html>
