@extends('umum.master')
@section('content')

<section class="keranjang" style="min-height: 500px; z-index: 9">
    <div class="pt-4 text-left">
        <h2 class="text-info">Jadwal Kursus Anda</h2>
        <a class=""> Dibawah ini adalah jadwal kursus anda yang sudah di setujui. </a>
    </div>

    <div class="pt-4 text-left">
        <div id="keranjangPesanan">
            <table class="table table-striped  table-bordered table-hover" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>No. Transaksi</th>

                    </tr>
                </thead>

                <tbody>
                    @php $i=1; @endphp
                    @foreach($jadwal as $m)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$m->tanggal}}</td>
                        <td>{{$m->waktu}}</td>
                        <td>{{$m->noTrans}}</td>

                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection


@section('footer')
<section>
    <footer>
        <div class="footer">
            &copy; Copyright 2019
        </div>
    </footer>
</section>
@endsection


@section('css')
@endsection

@section('script')
@endsection
