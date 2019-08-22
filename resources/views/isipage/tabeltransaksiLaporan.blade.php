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

            <td>
                <button class="btn btn-warning btn-sm pull-center" onclick="tampilDetail('{{$dt->noTrans}}')" data-toggle="modal" data-target="#modalDetail"><i class="fa fa-bars" aria-hidden="true"></i></button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="w-50 pull-right">
    <div class="form-group row">
        <label for="grandTotal" class="col-sm-4 col-form-label">Grand Total</label>
        <div class="col-sm-8">
            <input type="text" readonly class="form-control text-bold text-dark" id="grandTotal" value="{{formatRupiah($grandTotal)}}">
        </div>
    </div>
</div>

<script>
    function setid(id) {
        $("#idPesananRequest").val(id);
    }

    function kepembayaran() {

    }
</script>
