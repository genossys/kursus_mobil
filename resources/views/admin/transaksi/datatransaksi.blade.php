@extends('admin.master')

@section('judul')
Data Transaksi
@endsection

@section('content')


<!-- Button to Open the Modal -->

<div class="pt-4">

    <div class="row mb-3s">
        <div class="col-sm-5 ">
            <div class="form-group">
                <label>Tanggal Transaksi:</label>

                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                    </div>
                    <input type="text" class="form-control float-right" id="reservation">
                </div>
            </div>
        </div>
    </div>

</div>

<div class="table-responsive-lg">
    <table id="example2" class="table table-striped  table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>#</th>
                <th>No. Trans</th>
                <th>Nama Customer</th>
                <th>Total</th>
                <th>Tanggal</th>
                <th>Batas Pembayaran</th>
                <th>Status Bayar</th>
                <th>Status Terima</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>

</div>


<!--Srart Modal -->
<div class="modal fade" id="modalDetail">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Pesanan</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>


            <div class="modal-body">
                <div id='tampildetail'>

                </div>

                <div class="text-right">
                    <button id="btnTerima" class="btn btn-success"> Terima</button>
                    <button id="btnUbah" class="btn btn-warning"> Ubah</button>
                    <button id="btnTolak" class="btn btn-danger"> Tolak</button>
                </div>

            </div>
        </div>
    </div>
    <!-- EndModal -->

    @endsection

    @section('css')
    <link rel="stylesheet" href="{{ asset('/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('/adminlte/plugins/daterangepicker/daterangepicker-bs3.css')}}">
    @endsection


    @section('script')
    <script src="{{ asset('/js/tampilan/fileinput.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTablesBootstrap4.js') }}"></script>
    <script src="{{ asset('/js/Transaksi/transaksi.js') }}"></script>
    <script src="{{ asset ('/js/moment-with-locales.js')}}"></script>
    <script src="{{asset ('adminlte/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <script>
        $(function() {
            //Date range picker
            $('#reservation').daterangepicker()

        })

        function tampilDetail(noTrans) {

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
    </script>


    @endsection
