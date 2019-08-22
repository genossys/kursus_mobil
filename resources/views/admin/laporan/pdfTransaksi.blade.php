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
            <h3 style="margin: 0">Laporan Transaksi</h3>
            <p style="margin: 0">Periode : {{$dariTanggal}} - {{$sampaiTanggal}}</p>
            <p style="margin: 0">Status Pembayaran : @if($status_bayar == "") semua @else $status_bayar @endif</p>
            <p style="margin: 0">Status Transaksi : @if($status_terima == "") semua @else $status_terima @endif</p>
        </div>
    </div>
    <hr>

    <div class="row">
        <table class="table table-striped table-hover pt-3">
            <thead>
                <tr>
                    <th>#</th>
                    <th>no. Transaksi</th>
                    <th>Total</th>
                    <th>Tanggal Pemesanan</th>
                    <th>Batas Pembayaran</th>
                    <th>Status Bayar</th>
                    <th>Status Transaksi</th>
                </tr>
            </thead>
            <tbody>
                @php $i=1 @endphp
                @foreach($transaksi as $dt)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$dt->noTrans}}</td>
                    <td>{{formatRupiah($dt->total)}}</td>
                    <td>{{$dt->tanggal}}</td>
                    <td>{{$dt->batasPembayaran}}</td>
                    @if($dt->status_bayar == 'diterima')
                    <td class="text-success">{{$dt->status_bayar}}</td>
                    @elseif($dt->status_bayar == 'menunggu')
                    <td class="text-warning">{{$dt->status_bayar}}</td>
                    @else
                    <td class="text-danger">{{$dt->status_bayar}}</td>
                    @endif


                    @if($dt->status_terima == 'diterima')
                    <td class="text-success">{{$dt->status_terima}}</td>
                    @elseif($dt->status_terima == 'menunggu')
                    <td class="text-warning">{{$dt->status_terima}}</td>
                    @else
                    <td class="text-danger">{{$dt->status_terima}}</td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="row">
        <div class="w-50 pull-right">
            <div class="form-group row">
                <label for="grandTotal" class="col-sm-4 col-form-label">Grand Total</label>
                <div class="col-sm-8">
                    <input type="text" readonly class="form-control text-bold text-dark" id="grandTotal" value="{{formatRupiah($grandTotal)}}">
                </div>
            </div>
        </div>
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
