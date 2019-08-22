@extends('admin.master')

@section('judul')
Data Paket
@endsection

@section('content')


<!-- Button to Open the Modal -->

<div class="pt-4">

    <button id="tambahModal" type="button" class="btn btn-primary pull-left" onclick="showTambahPaket()">
        <span><i class="fa fa-plus-circle" aria-hidden="true"></i></span>
    </button>

</div>

<div class="table-responsive-lg">
    <table id="example2" class="table table-striped  table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Paket</th>
                <th>Type Mobil</th>
                <th>Pertemuan</th>
                <th>Jadwal Buka</th>
                <th>Jadwal Tutup</th>
                <th>Harga</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>

</div>


<!--Srart Modal -->
<div class="modal fade" id="modalPaket">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Paket</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form action="" method="POST" id="formcustomer" class="form">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="alert alert-danger" style="display:none"></div>
                    <div class="alert alert-success" style="display:none"></div>
                    <input type="hidden" name="oldusername" id="oldusername">

                    <input type="text" id="idPaket" name="idPaket" hidden />
                    <div class="form-group">
                        <label>Nama Paket</label>
                        <input type="text" class="form-control" placeholder="Nama Paket" id="namaPaket" name="namaPaket">
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Type Mobil</label>
                                <select class="form-control" id="typeMobil" name="typeMobil">
                                    <option value="Automatic">Automatic</option>
                                    <option value="Manual">Manual</option>
                                    <option value="Kombinasi">Kombinasi</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Kali Pertemuan</label>
                                <input id="kaliPertemuan" type="number" class="form-control" name="kaliPertemuan">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Jam Buka</label>
                                <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker1" id="jadwalBuka" name="jadwalBuka"/>
                                    <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker" >
                                        <div class="input-group-text"><i class="fa fa-clock-o"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="bootstrap-timepicker">
                                <div class="form-group">
                                    <label>Jadwal Tutup</label>
                                    <div class="input-group date" id="datetimepicker2" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker2" id="jadwalTutup" name="jadwalTutup" />
                                        <div class="input-group-append" data-target="#datetimepicker2" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-clock-o"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Harga Paket</label>
                                <input type="text" class="form-control" placeholder="Harga Paket" id="harga" name="harga" >
                            </div>
                        </div>
                    </div>

                    <div class="text-right">
                    <button id="btnSimpan" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i></button>
                    </div>
            </form>
        </div>
    </div>
</div>
<!-- EndModal -->

@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{ asset('/css/tempusdominus-bootstrap-4.min.css')}}" />
@endsection


@section('script')

<script src="{{ asset('/js/tampilan/fileinput.js') }}"></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTablesBootstrap4.js') }}"></script>
<script src="{{ asset ('/js/moment-with-locales.js')}}"></script>
<script type="text/javascript" src="{{ asset ('/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<script type="text/javascript">
    $(function() {
        $('#datetimepicker1').datetimepicker({
            format: 'HH:mm:ss'
        });
    });

    $(function() {
        $('#datetimepicker2').datetimepicker({
            format: 'HH:mm:ss'
        });
    });
</script>
<script src="{{ asset('/js/Master/paket.js') }}"></script>

@endsection
