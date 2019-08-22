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
