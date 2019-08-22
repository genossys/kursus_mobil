<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Nota Pembayaran</title>
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
            <h3 style="margin: 0">Nota Pembayaran</h3>
        </div>
    </div>
    <hr>

    <table>
        <tr>
            <td>Telah terima dari</td>
            <td>:&nbsp;</td>
            <td> {{$nota->usernameCustomer}}</td>
        </tr>

        <tr>
            <td>Sejumlah Uang</td>
            <td>:&nbsp;</td>
            <td style="font-weight: 900"> {{formatRupiah($nota->harga)}}</td>
        </tr>
    </table>

    <table class="table table-striped table-hover pt-3">
        <thead>
            <tr>
                <th>#</th>
                <th>no. Transaksi</th>
                <th>Nama Paket</th>
                <th>Customer</th>
                <th>Tanggal Mulai</th>
                <th>Jam</th>
                <th>harga</th>

            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>{{$nota->noTrans}}</td>
                <td>{{$nota->namaPaket}}</td>
                <td>{{$nota->usernameCustomer}}</td>
                <td>{{$nota->reqTglMulai}}</td>
                <td>{{$nota->reqWaktu}}</td>
                <td>{{formatRupiah($nota->harga)}}</td>
            </tr>
        </tbody>
    </table>

    <hr>

    <table style="width: 100%">
        <tr style="width: 100%; font-weight: 900">
            <td>Total</td>
            <td></td>
            <td style="width: 100%" class="text-right">{{formatRupiah($nota->harga)}}</td>
        </tr>
    </table>


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
