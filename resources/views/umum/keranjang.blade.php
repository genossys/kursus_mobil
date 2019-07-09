@extends('umum.master')
@section('content')

<section class="keranjang" style="min-height: 500px; z-index: 9">
    <div class="pt-4 text-left">
        <h2 class="text-info">Informasi</h2>
        <a class=""> Permintaan anda akan di konfirmasi setelah anda melakukan pembayaran,
            Anda dapat melakukan permintaan tanggal dan waktu, kursus akan di laksanakan setiap hari pada jam yang sama sesuai permintaan anda</a>
    </div>

    <div class="pt-4 text-left">
        <h5 class="text-info">No. Transaksi {{noTrans_otomatis(auth()->user()->idCustomer)}}</h5>
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
                <div class="form-group">
                    <label>Tanggal Mulai</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-calendar"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control float-right datepicker" name="reqTglMulai" id="reqTglMulai">
                    </div>
                </div>

                <div class="bootstrap-timepicker">
                    <div class="form-group">
                        <label>Jam</label>
                        <div class="input-group date" id="datetimepicker2" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker2" id="jadwalTutup" name="jadwalTutup" />
                            <div class="input-group-append" data-target="#datetimepicker2" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-clock-o"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
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
<script src="{{ asset('js/dataTablesBootstrap4.js') }}"></script>
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
    function tampilKeranjang() {

        var idCustomer = $("#idCustomer").val();

        $.ajax({
            type: 'GET',
            url: '/checkoutPesanan',
            data: {
                idCustomer: idCustomer,
            },
            success: function(data) {
                $("#keranjangPesanan").html(data.html);
            }
        });
    }

    $(window).on("load", function() {
        tampilKeranjang();
    });
</script>

@endsection
