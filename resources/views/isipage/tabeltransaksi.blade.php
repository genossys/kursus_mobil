<table class="table table-striped table-hover pt-3">
    <thead>
        <tr>
            <th>#</th>
            <th>no. Transaksi</th>
            <th>Total</th>
            <th>Tanggal Pemesanan</th>
            <th>Batas Pembayaran</th>
            <th>Status Bayar</th>
            <th>Status di terima</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @php $i=1 @endphp
        @foreach($daftartransaksi as $dt)
        <tr>
            <td>{{$i++}}</td>
            <td>{{$dt->noTrans}}</td>
            <td>{{formatRupiah($dt->total)}}</td>
            <td>{{$dt->tanggal}}</td>
            <td>{{$dt->batasPembayaran}}</td>
            <td>{{$dt->status_bayar}}</td>
            <td>{{$dt->status_terima}}</td>
            <td>
                <a class="btn btn-warning btn-sm pull-center" href="/pembayaran/{{$dt->noTrans}}"> Konfirmasi</a>
                <button class="btn btn-info btn-sm pull-center" data-toggle="modal" data-target="#exampleModal" onclick=""> Detail</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<script>
    function setid(id) {
        $("#idPesananRequest").val(id);
    }

    function kepembayaran() {

    }
</script>
