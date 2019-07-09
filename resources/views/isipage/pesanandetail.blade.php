<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Pesanan</th>
            <th>Sub Total</th>
            <th>Req. Tanggal</th>
            <th>Req. Jam</th>
            <th>Batas Pembayaran</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @php $i=1 @endphp
        @foreach($dataPesanan as $dp)
        <tr>
            <td>{{$i++}}</td>
            <td>{{$dp->namaPaket}}</td>
            <td>{{formatRupiah($dp->harga)}}</td>
            <td>{{$dp->reqTglMulai}}</td>
            <td>{{$dp->reqWaktu}}</td>
            <td>{{$dp->batasPembayaran}}</td>
            <td>
                <button class="btn btn-warning btn-sm pull-center" data-toggle="modal" data-target="#exampleModal"> <i class="fa fa-arrow-circle-o-up" aria-hidden="true"></i></button>
                <button class="btn btn-danger btn-sm pull-center" onclick="deletePesanan('{{$dp->id}}')"> <i class="fa fa-close" aria-hidden="true"></i></button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<h5 class="text-right"> Total: {{formatRupiah($total)}}</h5>
<button class="btn btn-info pull-right mt-2" data-widget="control-sidebar">Check Out</button>
