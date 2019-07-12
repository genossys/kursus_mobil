<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Pesanan</th>
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
            <td>{{formatRupiah($dp->harga)}}</td>
            <td>
                <button class="btn btn-danger btn-sm pull-right" onclick="deletePesanan('{{$dp->id}}')"> <i class="fa fa-close" aria-hidden="true"></i></button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<h5 class="text-right"> {{formatRupiah($total)}}</h5>
<a href="/keranjangPesanan" class="btn btn-info pull-right mt-2">Check Out</a>
