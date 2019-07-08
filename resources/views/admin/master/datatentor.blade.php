@extends('admin.master')

@section('judul')
Data Tentor
@endsection

@section('content')


<!-- Button to Open the Modal -->

<div class="pt-4">

    <button id="tambahModal" type="button" class="btn btn-primary pull-left" onclick="showTambahTentor()">
        <span><i class="fa fa-plus-circle" aria-hidden="true"></i></span>
    </button>

</div>

<div class="table-responsive-lg">
    <table id="example2" class="table table-striped  table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Tentor</th>
                <th>Tanggal Lahir</th>
                <th>Biodata</th>
                <th>Foto</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>

</div>


<!--Srart Modal -->
<div class="modal fade" id="modalTentor">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Tentor</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form action="" method="POST" id="formcustomer" class="form">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="alert alert-danger" style="display:none"></div>
                    <div class="alert alert-success" style="display:none"></div>
                    <input type="hidden" name="oldusername" id="oldusername">

                    <input type="text" id="idTentor" name="idTentor" hidden />

                    <div class="form-group">
                        <label>Nama Tentor</label>
                        <input type="text" class="form-control" placeholder="Nama Tentor" id="namaTentor" name="namaTentor">
                    </div>


                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-calendar"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control float-right datepicker" name="tanggalLahir" id="tanggalLahir">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Biodata </label>
                        <textarea class="form-control" rows="3" id="biodata" name="biodata"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Foto Tentor </label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="foto" name="foto">
                            <label class="custom-file-label" for="customFile">Pilih file</label>
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
<link rel="stylesheet" href="{{ asset('/css/bootstrap-datepicker.min.css')}}">
@endsection


@section('script')
<script src="{{ asset('/js/tampilan/fileinput.js') }}"></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTablesBootstrap4.js') }}"></script>
<script src="{{ asset('/js/Master/tentor.js') }}"></script>
<script src="{{ asset('/js/bootstrap-datepicker.min.js') }}"></script>
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
