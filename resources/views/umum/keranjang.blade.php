@extends('umum.master')
@section('content')

<section class="keranjang" style="min-height: 500px; z-index: 9">
    <div class="pt-4 text-left">
        <h2 class="text-info">Informasi</h2>
        <a class=""> Permintaan anda akan di konfirmasi setelah anda melakukan pembayaran,
            Anda dapat melakukan permintaan tanggal dan waktu, kursus akan di laksanakan setiap hari pada jam yang sama sesuai permintaan anda</a>
    </div>

    <div class="pt-4 text-left">
        <h5 class="text-info">No. Transaksi {{noTrans_otomatis(auth()->user()->username)}}</h5>
        <div id="keranjangPesanan">

        </div>
    </div>
</section>

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
                    <div class="input-group">
                        <input type="text" class="form-control float-left" name="namaTentor" id="namaTentor" onclick="PencarianTentor()" readonly>
                        <div class="input-group-append">
                            <button class="btn btn-info input-group-text" onclick="PencarianTentor()" data-toggle="modal" data-target="#modalTentor" >
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
@endsection


@section('footer')
<section>
    <footer>
        <div class="footer">
            &copy; Copyright 2019
        </div>
    </footer>
</section>
@endsection


@section('css')
<link rel="stylesheet" href="{{ asset('/css/tempusdominus-bootstrap-4.min.css')}}" />
<link rel="stylesheet" href="{{ asset('/css/bootstrap-datepicker.min.css')}}">
@endsection

@section('script')
<script src="{{ asset('/js/tampilan/genosstyle.js') }}"></script>
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
</script>

<script>
    function requestKusrsus() {

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
                    title: 'Request anda di masukan',
                    showConfirmButton: false,
                    timer: 1500
                });
                tampilKeranjang()
            }
        });
    }

    function tampilKeranjang() {

        var username = $("#username").val();

        $.ajax({
            type: 'GET',
            url: '/checkoutPesanan',
            data: {
                username: username,
            },
            success: function(data) {
                $("#keranjangPesanan").html(data.html);
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
        tampilKeranjang();
    });
</script>

@endsection
