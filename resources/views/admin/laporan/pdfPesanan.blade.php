<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laporan Trasaksi</title>
    <!-- Fonts -->

    <!-- Styles -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/bootstrap3.min.css" type="text/css">
</head>

<body>

    <style>
        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 0cm;
        }
    </style>

    <div class="row w-100">
        <div class="col-xs-6">
            <h1 style="margin: 0">Gajah Mada Baru</h1>
            <p style="margin: 0">Jl. Hasanudin No. 139 Punggawan, Banjarsari, Solo</p>
            <p style="margin: 0">Telp. (0271) 728872 / 081 667 4239</p>
        </div>

        <div class="col-xs-5 text-right">
            <h3 style="margin: 0">Laporan Pesanan</h3>
            <p style="margin: 0">Periode : {{$dariTanggal}} - {{$sampaiTanggal}}</p>
            <p style="margin: 0">Mobil : @if($mobil == "") semua @else $mobil @endif</p>
            <p style="margin: 0">Tentor : @if($tentor == "") semua @else $tentor @endif</p>
        </div>
    </div>
    <hr>

    <div class="row">
        <table class="table table-striped table-hover pt-3">
            <thead>
                <tr>
                    <th>#</th>
                    <th>no. Transaksi</th>
                    <th>Nama Paket</th>
                    <th>Customer</th>
                    <th>harga</th>
                    <th>Tanggal Mulai</th>
                    <th>Jam</th>
                    <th>Mobil</th>
                    <th>Tentor</th>
                </tr>
            </thead>
            <tbody>
                @php $i=1 @endphp
                @foreach($pesanan as $dt)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$dt->noTrans}}</td>
                    <td>{{$dt->namaPaket}}</td>
                    <td>{{$dt->usernameCustomer}}</td>
                    <td>{{formatRupiah($dt->harga)}}</td>
                    <td>{{$dt->reqTglMulai}}</td>
                    <td>{{$dt->reqWaktu}}</td>
                    <td>{{$dt->merkMobil}}</td>
                    <td>{{$dt->namaTentor}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <div class="row" style="margin-top: 50px">
        <div class="col-xs-6 offset-2">
            <p class="text-center" style="margin-bottom: 60px">Pimpinan</p>
            <p class="text-center">(...........................)</p>
        </div>

        <div class="col-xs-4">
            <p class="text-center" style="margin-bottom: 60px">Admin</p>
            <p class="text-center">(...........................)</p>
        </div>
    </div>



    <footer class="footer" style="margin-bottom: 10px">
        @php $date = new DateTime("now", new DateTimeZone('Asia/Bangkok') ); @endphp
        <p class="text-right small" style="margin: 0"> di cetak oleh : {{auth()->user()->username}}</p>
        <p class="text-right small" style="margin: 0"> tgl: {{ $date->format('d F Y, H:i:s') }} </p>
    </footer>

    <!-- JS -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap3.min.js"></script>
</body>

</html>
