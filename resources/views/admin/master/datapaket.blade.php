@extends('admin.master')

@section('judul')
Data Paket
@endsection

@section('content')


<!-- Button to Open the Modal -->
<div>
    <button id="tambahModal" style="margin-bottom: 10px; margin-top: 20px" type="button" class="btn btn-primary box-tools pull-right" data-toggle="modal" data-target="#modaltambahPaket">
        Tambah Data Paket
    </button>

</div>

<div class="table-responsive-lg">
    <table id="example2" class="table table-striped  table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>#</th>
                <th>ID Paket</th>
                <th>Nama Paket</th>
                <th>Harga</th>
                <th>Dekripsi</th>
                <th>Type Mobil</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>

<!--Srart Modal -->
<div class="modal fade" id="modaltambahPaket">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Paket</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form action="" method="POST" id="formSimpanPaket" class="formPaket">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="alert alert-danger" style="display:none"></div>
                    <div class="alert alert-success" style="display:none"></div>

                    <div class="form-group">
                        <label id="labelIdPaket">ID Paket </label>
                        <input type="text" class="form-control" placeholder="ID" id="txtIdPaket" name="txtIdPaket">
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label id="labelNamaPaket">Nama Paket </label>
                                <input type="text" class="form-control" placeholder="Nama" id="txtNamaPaket" name="txtNamaPaket">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label id="labelHargaPaket">Harga Paket</label>
                                <input type="number" class="form-control" placeholder="Harga" id="txtHargaPaket" name="txtHargaPaket">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label id="labelKetPaket">Ket. Paket </label>
                        <textarea class="form-control" rows="3" id="txtKetPaket" name="txtKetPaket"></textarea>
                    </div>

                    <!-- select -->
                    <div class="form-group">
                        <label>Type Mobil</label>
                        <select class="form-control" id="cBoxTypeMobil">
                            <option value="Manual" default>Manual</option>
                            <option value="Auto">Auto</option>
                            <option value="Kombinasi">Kombinasi</option>
                        </select>
                    </div>

                    <div class="text-right">
                        <button id="btnSimpan" class="btn btn-primary"></button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
<!-- EndModal -->

@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('/css/bootstrap-datepicker.min.css')}}">
<link rel="stylesheet" href="{{ asset('/css/autotext.css')}}">
@endsection


@section('script')
<script src="{{ asset('/js/tampilan/fileinput.js') }}"></script>
<script src="{{ asset('/js/tampilan/dataPaket.js') }}"></script>
<script src="{{ asset('/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('/js/tampilan/autotextidlelang.js') }}"></script>
<script type="text/javascript">
    $(function() {
        $(".datepicker").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
        });
    });
</script>

@endsection
