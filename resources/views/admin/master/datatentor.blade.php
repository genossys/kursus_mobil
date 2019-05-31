@extends('admin.master')

@section('judul')
Data Tentor
@endsection

@section('content')


<!-- Button to Open the Modal -->
<div>
    <button id="tambahModal" style="margin-bottom: 10px; margin-top: 20px" type="button" class="btn btn-primary box-tools pull-right" data-toggle="modal" data-target="#modaltambahTentor">
        Tambah Data Tentor
    </button>

</div>

<div class="table-responsive-lg">
    <table id="example2" class="table table-striped  table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>#</th>
                <th>ID Tentor</th>
                <th>Nama Tentor</th>
                <th>Alamat</th>
                <th>Tgl. Lahir</th>
                <th>Pengalaman</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>

<!--Srart Modal -->
<div class="modal fade" id="modaltambahTentor">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Tentor</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form action="" method="POST" id="formSimpanTentor" class="formTentor">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="alert alert-danger" style="display:none"></div>
                    <div class="alert alert-success" style="display:none"></div>

                    <div class="form-group">
                        <label>ID Tentor </label>
                        <input type="text" class="form-control" placeholder="ID" id="txtIdTentor" name="txtIdTentor">
                    </div>

                    <div class="form-group">
                        <label>Nama Tentor </label>
                        <input type="text" class="form-control" placeholder="Nama" id="txtNamaTentor" name="txtNamaTentor">
                    </div>

                    <div class="form-group">
                        <label>Alamat </label>
                        <input type="text" class="form-control" placeholder="Nama" id="txtAlamatTentor" name="txtAlamatTentor">
                    </div>

                    <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control float-right datepicker" name="dateTanggalLahir" id="dateTanggalLahir">
                                </div>
                            </div>

                    <div class="form-group">
                        <label>Profile Tentor</label>
                        <textarea class="form-control" rows="3" id="txtProfileTentor" name="txtProfileTentor"></textarea>
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
<script src="{{ asset('/js/tampilan/dataTentor.js') }}"></script>
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
