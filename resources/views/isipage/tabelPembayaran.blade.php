<div class="table-responsive-lg">
    <table class="table table-striped  table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Nomor Transaksi</th>
                <th>Tanggal</th>
                <th>Bank</th>
                <th>Status Pembayaran</th>
                <th>Bukti</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @php $i=1; @endphp
            @foreach($pembayaran as $m)
            <tr>
                <td>{{$i++}}</td>
                <td>{{$m->noTrans}}</td>
                <td>{{$m->tanggal}}</td>
                <td>{{$m->bank}}</td>
                @if($m->status_bayar == 'diterima')
                <td class="text-success">{{$m->status_bayar}}</td>
                @elseif($m->status_bayar == 'menunggu')
                <td class="text-warning">{{$m->status_bayar}}</td>
                @else
                <td class="text-danger">{{$m->status_bayar}}</td>
                @endif
                <td> <a href="{{asset ('/bukti/'.$m->bukti)}}" target="_blank"><img src="{{asset ('/bukti/'.$m->bukti)}}" alt="" style="width: 100px;height: 100px;object-fit: cover"></a></td>
                <td style="min-width: 100px">
                    <button class="btn btn-info btn-sm pull-center" onclick="terimaPembayaran('{{$m->noTrans}}')"> Terima</button>
                    <button class="btn btn-danger btn-sm pull-center" onclick="tolakPembayaran('{{$m->noTrans}}')"> Tolak</button>
                    <a class="btn btn-warning btn-sm pull-center" href="/admin/cetak/cetakNota/{{$m->noTrans}}" target="_blank"> Cetak Nota</a>
                </td>
            </tr>

            @endforeach

        </tbody>

    </table>
</div>
