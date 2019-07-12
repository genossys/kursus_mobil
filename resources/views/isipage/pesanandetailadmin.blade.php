<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Pesanan</th>
            <th>Req. Tanggal</th>
            <th>Req. Jam</th>
            <th>Req. Mobil</th>
            <th>Req. Tentor</th>
            <th>Sub Total</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @php $i=1 @endphp
        @foreach($dataPesanan as $dp)
        <tr>
            <td>{{$i++}}</td>
            <td>{{$dp->namaPaket}}</td>
            <td>{{$dp->reqTglMulai}}</td>
            <td>{{$dp->reqWaktu}}</td>
            <td>{{$dp->merkMobil}}</td>
            <td>{{$dp->namaTentor}}</td>
            <td>{{formatRupiah($dp->harga)}}</td>
            <td>
                <button class="btn btn-warning btn-sm pull-center" data-toggle="modal" data-target="#exampleModal" onclick="setid('{{$dp->id}}')"> <i class="fa fa-clock-o" aria-hidden="true"></i></button>
                <button class="btn btn-danger btn-sm pull-center" onclick="deletePesanan('{{$dp->id}}')"> <i class="fa fa-close" aria-hidden="true"></i></button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
