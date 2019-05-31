@extends('admin.master')

@section('judul')
Data Mobil
@endsection

@section('content')


<!-- Button to Open the Modal -->
<div>
    <button id="tambahModal" style="margin-bottom: 10px; margin-top: 20px" type="button" class="btn btn-primary box-tools pull-right" data-toggle="modal" data-target="#modaltambahMobil">
        Tambah Data Mobil
    </button>

</div>

<div class="table-responsive-lg">
    <table id="example2" class="table table-striped  table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Merk</th>
                <th>Type Mobil</th>
                <th>Spesifikasi</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>

<!--Srart Modal -->
<div class="modal fade" id="modaltambahMobil">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Mobil</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form action="" method="POST" id="formSimpanMobil" class="formMobil">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="alert alert-danger" style="display:none"></div>
                    <div class="alert alert-success" style="display:none"></div>

                    <div class="form-group">
                        <label>Plat Nomor </label>
                        <input type="text" class="form-control" placeholder="ID" id="txtPlatno" name="txtPlatno">
                    </div>

                    <div class="form-group">
                        <label>Merk Mobil </label>
                        <input type="text" class="form-control" placeholder="Nama" id="txtMerkMobil" name="txtMerkMobil">
                    </div>

                    <div class="form-group">
                        <label>Spesifikasi </label>
                        <textarea class="form-control" rows="3" id="txtSpesifikasi" name="txtSpesifikasi"></textarea>
                    </div>

                    <!-- select -->
                    <div class="form-group">
                        <label>Type Mobil</label>
                        <select class="form-control" id="cBoxTypeMobil">
                            <option value="Manual" default>Manual</option>
                            <option value="Auto">Auto</option>
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
<script src="{{ asset('/js/tampilan/dataMobil.js') }}"></script>
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
