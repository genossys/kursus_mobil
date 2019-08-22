@extends('admin.master')

@section('judul')
Laporan Data Pesanan
@endsection

@section('content')


<!-- Button to Open the Modal -->
<section class="pt-3">
    <form action="{{route('cetakPesanan')}}" method="get" target="_blank">
        <input id="dariTanggal" name="dariTanggal" hidden>
        <input id="sampaiTanggal" name="sampaiTanggal" hidden>

        <div class="row">
            <div class="col-sm-6 ">
                <div class="form-group">
                    <label>Tanggal Mulai Kursus:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>
                        <input type="text" class="form-control float-right" id="tanggal" onchange="showData()">
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <label>Mobil</label>
                    <select class="form-control" id="mobil" name="mobil" onchange="showData()">
                        <option value="">Semua</option>
                        @foreach($mobil as $m)
                        <option value="{{$m->merkMobil}}">{{$m->merkMobil}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label>Tentor</label>
                    <select class="form-control" id="tentor" name="tentor" onchange="showData()">
                        <option value="">Semua</option>
                        @foreach($tentor as $t)
                        <option value="{{$t->namaTentor}}">{{$t->namaTentor}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-1">
                <label><br></label>
                <button type="submit" class="btn btn-warning"><i class="fa fa-print" aria-hidden="true"></i>&nbsp; Cetak</button>
            </div>
        </div>
    </form>
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
            </div>
        </div>
    </div>
</div>
<!-- EndModal -->

@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('/adminlte/plugins/daterangepicker/daterangepicker-bs3.css')}}">
@endsection


@section('script')
<script src="{{asset ('/js/moment-with-locales.js')}}"></script>
<script src="{{asset ('adminlte/plugins/daterangepicker/daterangepicker.js')}}"></script>
<script>
    $(function() {
        //Date range picker
        $('#tanggal').daterangepicker()

    })
</script>

<script>
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

    function showData() {
        var rangeTanggal = $("#tanggal").val();
        var dariTanggal = rangeTanggal.substring(0, 10);
        var dariTanggalFormat = moment(dariTanggal, "MM/DD/YYYY").format("YYYY-MM-DD");

        var sampaiTanggal = rangeTanggal.substring(13, 23);
        var sampaiTanggalFormat = moment(sampaiTanggal, "MM/DD/YYYY").format("YYYY-MM-DD");

        var tentor = $("#tentor").val();
        var mobil = $("#mobil").val();

        $("#dariTanggal").val(dariTanggalFormat);
        $("#sampaiTanggal").val(sampaiTanggalFormat);

        $.ajax({
            type: 'GET',
            url: '/admin/pesanan/showlaporanpesanan',
            data: {
                dariTanggal: dariTanggalFormat,
                sampaiTanggal: sampaiTanggalFormat,
                mobil: mobil,
                tentor: tentor,
            },
            success: function(response) {

                $("#tabelDisini").html(response.html);
            },
            error: function(response) {
                alert('gagal \n' + response.responseText);
            }
        });
    }

    $(window).on("load", function() {

    });
</script>


@endsection
