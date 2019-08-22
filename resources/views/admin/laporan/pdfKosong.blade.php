<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laporan Mobil</title>
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
            <h3 style="margin: 0">Laporan Mobil</h3>
        </div>
    </div>
    <hr>

    <h2 style="text-align: center"> Data yang anda cari tidak ada</h2>


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
