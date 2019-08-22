@extends('admin.master')

@section('judul')
Data Pembayaran
@endsection

@section('content')


<!-- Button to Open the Modal -->
<section class="mb-5">
    <div class="pt-3">

        <div class="pull-right">
            <input id="caridata" type="text" class="form-control" name='caridata' onkeyup="showData()" />
        </div>
        <label class="pull-right mt-2"> Cari &nbsp;</label>
    </div>

</section>

<div id="tabelDisini"></div>

</div>

<!--Srart Modal -->
<div class="modal fade" id="modalDetail">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Pesanan</h4>
                <input id="nomorPembayaran" name="nomorPembayaran" hidden>
                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>


            <div class="modal-body">
                <div id='tampildetail'>

                </div>

                <div class="text-right">
                    <button id="btnTerima" class="btn btn-success" onclick="terimaPesanan()"> Terima</button>
                    <button id="btnUbah" class="btn btn-warning" onclick="ubahPesanan()"> Ubah</button>
                    <button id="btnTolak" class="btn btn-danger" onclick="tolakPesanan()"> Tolak</button>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- EndModal -->

@endsection

@section('css')
@endsection


@section('script')
<script>
    function tampilDetail(noTrans) {
        $("#nomorPembayaran").val(noTrans);
        $.ajax({
            type: 'GET',
            url: '/pesananadmin',
            data: {
                noTrans: noTrans,
            },
            success: function(data) {
                $("#tampildetail").html(data.html);
            }
        });
    }

    function terimaPesanan() {

        var noTrans = $('#nomorPembayaran').val();
        var noHp = $('#noHp').val();
        $.ajax({
            type: 'POST',
            url: '/admin/pembayaran/updateStatusTerima',
            data: {
                noTrans: noTrans,
                statusTerima: 'diterima',
            },
            success: function(data) {
                $('#modalDetail').modal('toggle');
                Swal.fire({
                    type: 'success',
                    title: 'data pesanan diterima',
                    showConfirmButton: false,
                    timer: 1500
                })
                showData();

                window.open('https://wa.me/' + noHp + '?text=Kami%20dari%20Kursus%20Mobil%20Gajah%20Mada,%20Permintaan%20anda%20kami%20setujui');
            }
        });
    }

    function ubahPesanan() {

        var noTrans = $('#nomorPembayaran').val();
        var noHp = $('#noHp').val();
        $.ajax({
            type: 'POST',
            url: '/admin/pembayaran/updateStatusTerima',
            data: {
                noTrans: noTrans,
                statusTerima: 'menunggu',
            },
            success: function(data) {
                $('#modalDetail').modal('toggle');
                Swal.fire({
                    type: 'success',
                    title: 'data pesanan di ubah',
                    showConfirmButton: false,
                    timer: 1500
                })
                showData();

                window.open('https://wa.me/' + noHp + '?text=Kami%20dari%20Kursus%20Mobil%20Gajah%20Mada,%20Permintaan%20anda%20kami%20rubah%20karena');
            }
        });
    }

    function tolakPesanan() {

        var noTrans = $('#nomorPembayaran').val();
        var noHp = $('#noHp').val();
        $.ajax({
            type: 'POST',
            url: '/admin/pembayaran/updateStatusTerima',
            data: {
                noTrans: noTrans,
                statusTerima: 'ditolak',
            },
            success: function(data) {
                $('#modalDetail').modal('toggle');
                Swal.fire({
                    type: 'success',
                    title: 'data pesanan ditolak',
                    showConfirmButton: false,
                    timer: 1500
                })
                showData();

                window.open('https://wa.me/' + noHp + '?text=Kami%20dari%20Kursus%20Mobil%20Gajah%20Mada,%20Permintaan%20anda%20kami%20tolak%20karena');
            }
        });
    }

    function showData() {
        var caridata = $("#caridata").val();

        $.ajax({
            type: 'GET',
            url: '/admin/pembayaran/showpembayaran',
            data: {
                caridata: caridata,
            },
            success: function(response) {

                $("#tabelDisini").html(response.html);
            },
            error: function(response) {
                alert('gagal \n' + response.responseText);
            }
        });
    }

    function terimaPembayaran(noTrans) {
        Swal.fire({
            title: 'Anda yakin?',
            text: "pembayaran ini di terima!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: '/admin/transaksi/updateStatusPembayaran',
                    data: {
                        noTrans: noTrans,
                        status: "diterima",
                    },
                    success: function(response) {

                        Swal.fire(
                            'Berhasil',
                            'Pembayaran di terima',
                            'success'
                        )
                        showData();
                    },
                    error: function(response) {
                        alert('gagal \n' + response.responseText);
                    }
                });
            }
        })
    }

    function tolakPembayaran(noTrans) {
        Swal.fire({
            title: 'Anda yakin?',
            text: "pembayaran ini di tolak!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: '/admin/transaksi/updateStatusPembayaran',
                    data: {
                        noTrans: noTrans,
                        status: "ditolak",
                    },
                    success: function(response) {

                        Swal.fire(
                            'Berhasil',
                            'Pembayaran di tolak',
                            'success'
                        )
                        showData();
                    },
                    error: function(response) {
                        alert('gagal \n' + response.responseText);
                    }
                });
            }
        })
    }

    $(window).on("load", function() {
        showData();
    });
</script>


@endsection
