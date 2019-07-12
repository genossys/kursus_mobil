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

<div class="row mb-3">
    <div class="col-md-4">
        <button class="btn btn-lg btn-info pull-left" onclick="bayarsekarang('{{$total}}')">Bayar Sekarang</button>
    </div>
    <div class="col-md-8">
        <h2 class="text-right"> Total: {{formatRupiah($total)}}</h2>
    </div>

</div>



<script>
    var noTrans = $("#noTrans").val();
    var idCustomer = $('#idCustomer').val();
    var fullDate = new Date();
    var twoDigitMonth = ((fullDate.getMonth().length + 1) === 1) ? (fullDate.getMonth() + 1) : '0' + (fullDate.getMonth() + 1);
    var tanggal = fullDate.getFullYear() + "-" + twoDigitMonth + "-" + fullDate.getDate();

    var fullDateBatas = new Date(fullDate);
    fullDateBatas.setDate(fullDate.getDate() + 3);
    var twoDigitMonthBatas = ((fullDateBatas.getMonth().length + 1) === 1) ? (fullDateBatas.getMonth() + 1) : '0' + (fullDateBatas.getMonth() + 1);
    var batasPembayaran = fullDateBatas.getFullYear() + "-" + twoDigitMonthBatas + "-" + fullDateBatas.getDate();

    function setid(id) {
        $("#idPesananRequest").val(id);
    }

    function insertketransaksi(total) {


        $.ajax({
            type: 'POST',
            url: '/insertTransaksi',
            data: {
                noTrans: noTrans,
                idCustomer: idCustomer,
                tanggal: tanggal,
                batasPembayaran: batasPembayaran,
                total: total
            },
            success: function(data) {
                window.location.href = "{{URL::to('/historyTransaksi')}}"
            }
        });
    }


    function bayarsekarang(total) {

        var noTrans = $("#noTrans").val();
        var idCustomer = $('#idCustomer').val();
        $.ajax({
            type: 'POST',
            url: '/bayarsekarang',
            data: {
                noTrans: noTrans,
                idCustomer: idCustomer,
            },
            success: function(data) {
                Swal.fire({
                    type: 'success',
                    title: 'Lakukan pembayaran sebelum tanggal '+batasPembayaran,
                    showConfirmButton: false,
                    timer: 1500
                });
                insertketransaksi(total);

            }
        });
    }
</script>
