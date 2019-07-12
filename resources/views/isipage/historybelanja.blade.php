<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>noTrans</th>
            <th>total</th>
            <th>tanggal</th>
            <th>batasPembayaran</th>
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

<div class="row">
    <div class="col-md-4">
        <button class="btn btn-lg btn-info pull-left" onclick="kepembayaran">Bayar Sekarang</button>
    </div>
    <div class="col-md-8">
        <h2 class="text-right"> Total: {{formatRupiah($total)}}</h2>
    </div>
</div>



<script>
    function setid(id) {
        $("#idPesananRequest").val(id);
    }

    function kepembayaran(){

    }
</script>
