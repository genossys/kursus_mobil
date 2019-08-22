@extends('admin.master')

@section('judul')
Data Transaksi
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
                <input id="nomorTransaksi" name="nomorTransaksi" hidden>
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


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Request</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input hidden id="idPesananRequest" name="idPesananRequest">
                <input hidden id="reqMobil" name="reqMobil">
                <input hidden id="reqTentor" name="reqTentor">
                <div class="form-group">
                    <label>Tanggal Mulai</label>
                    <div class="input-group">

                        <input type="text" class="form-control float-left datepicker" name="reqTglMulai" id="reqTglMulai">
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="fa fa-calendar"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="bootstrap-timepicker">
                    <div class="form-group">
                        <label>Jam</label>
                        <div class="input-group date" id="datetimepicker2" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-toggle="datetimepicker" data-target="#datetimepicker2" id="jadwalTutup" name="jadwalTutup" value="08:00:00" />
                            <div class="input-group-append" data-target="#datetimepicker2" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-clock-o"></i></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Mobil</label>
                    <div class="input-group">
                        <input type="text" class="form-control float-left" name="merkMobil" id="merkMobil" onclick="PencarianMobil()" readonly>
                        <div class="input-group-append">
                            <button class="btn btn-info input-group-text" onclick="PencarianMobil()" data-toggle="modal" data-target="#modalMobil">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Tentor</label>
                    <div class="input-group ">
                        <input type="text" class="form-control float-left" name="namaTentor" id="namaTentor" onclick="PencarianTentor()" readonly>
                        <div class="input-group-append">
                            <button class="btn btn-info input-group-text" onclick="PencarianTentor()" data-toggle="modal" data-target="#modalTentor">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="requestKusrsus()" data-toggle="modal" data-target="#exampleModal">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalMobil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Request Mobil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group">
                    <input type="text" class="form-control float-left" onKeyUp="PencarianMobil()" name="cariMobil" id="cariMobil">
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <i class=" fa fa-search"></i>
                        </span>
                    </div>
                </div>
                <div id="pencarianMobil">

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tentor-->
<div class="modal fade" id="modalTentor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Request Tentor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group">
                    <input type="text" class="form-control float-left" onKeyUp="PencarianTentor()" name="cariTentor" id="cariTentor">
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <i class=" fa fa-search"></i>
                        </span>
                    </div>
                </div>
                <div id="pencarianTentor">

                </div>
            </div>
        </div>
    </div>
</div>
<!-- EndModal -->

@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('/css/tempusdominus-bootstrap-4.min.css')}}" />
<link rel="stylesheet" href="{{ asset('/css/bootstrap-datepicker.min.css')}}">
@endsection


@section('script')
<script src="{{ asset ('/js/moment-with-locales.js')}}"></script>
<script type="text/javascript" src="{{ asset ('/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<script src="{{ asset('/js/bootstrap-datepicker.min.js') }}"></script>
<script type="text/javascript">
    $(function() {
        $('#datetimepicker2').datetimepicker({
            format: 'HH:mm:ss'
        });
    });

    $(function() {
        $(".datepicker").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
        });
    });

    function tampilDetail(noTrans) {
        $("#nomorTransaksi").val(noTrans);
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

        var noTrans = $('#nomorTransaksi').val();
        var noHp = $('#noHp').val();
        $.ajax({
            type: 'POST',
            url: '/admin/transaksi/updateStatusTerima',
            data: {
                noTrans: noTrans,
                statusTerima: 'diterima',
            },
            success: function(data) {
                $.ajax({
                    type: 'POST',
                    url: '/admin/jadwal/insertJadwal',
                    data: {
                        noTrans: noTrans,
                    },
                    success: function(data) {
                        $('#modalDetail').modal('toggle');
                        Swal.fire({
                            type: 'success',
                            title: 'data pesanan diterima',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        showData();
                        window.open('https://wa.me/' + noHp + '?text=Kami%20dari%20Kursus%20Mobil%20Gajah%20Mada,%20Permintaan%20anda%20kami%20setujui');
                    }
                });
            }
        });
    }



    function ubahPesanan() {

        var noTrans = $('#nomorTransaksi').val();
        var noHp = $('#noHp').val();
        $.ajax({
            type: 'POST',
            url: '/admin/transaksi/updateStatusTerima',
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

        var noTrans = $('#nomorTransaksi').val();
        var noHp = $('#noHp').val();
        $.ajax({
            type: 'POST',
            url: '/admin/transaksi/updateStatusTerima',
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
            url: '/admin/transaksi/showtransaksi',
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

    function requestKusrsus() {
        var noTrans = $('#nomorTransaksi').val();
        var idPesanan = $("#idPesananRequest").val();
        var reqtgl = $("#reqTglMulai").val();
        var reqjam = $("#jadwalTutup").val();
        var reqMobil = $("#reqMobil").val();
        var reqTentor = $("#reqTentor").val();


        $.ajax({
            type: 'POST',
            url: '/requestKursus',
            data: {
                "_token": "{{ csrf_token() }}",
                idPesanan: idPesanan,
                reqtgl: reqtgl,
                reqjam: reqjam,
                reqMobil: reqMobil,
                reqTentor: reqTentor,
            },
            success: function(data) {
                Swal.fire({
                    position: 'top-end',
                    type: 'success',
                    title: 'Pesanan di ubah',
                    showConfirmButton: false,
                    timer: 1500
                });
                tampilDetail(noTrans)
            }
        });
    }

    function PencarianMobil() {

        var cariMobil = $("#cariMobil").val();
        $.ajax({
            type: 'GET',
            url: '/pencarianMobil',
            data: {
                cariMobil: cariMobil
            },
            success: function(data) {
                $("#pencarianMobil").html(data.html);
            }
        });
    }

    function PencarianTentor() {

        var cariTentor = $("#cariTentor").val();
        $.ajax({
            type: 'GET',
            url: '/pencarianTentor',
            data: {
                cariTentor: cariTentor
            },
            success: function(data) {
                $("#pencarianTentor").html(data.html);
            }
        });
    }

    $(window).on("load", function() {
        showData();
    });
</script>


@endsection
