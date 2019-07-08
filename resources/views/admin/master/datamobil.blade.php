@extends('admin.master')

@section('judul')
Data Mobil
@endsection

@section('content')


<!-- Button to Open the Modal -->

<div class="pt-4">

    <button id="tambahModal" type="button" class="btn btn-primary pull-left" onclick="showTambahMobil()">
        <span><i class="fa fa-plus-circle" aria-hidden="true"></i></span>
    </button>

</div>

<div class="table-responsive-lg">
    <table id="example2" class="table table-striped  table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Merk Mobil</th>
                <th>Type Mobil</th>
                <th>Tahun</th>
                <th>Nopol</th>
                <th>Gambar</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>

</div>


<!--Srart Modal -->
<div class="modal fade" id="modalMobil">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Mobil</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form action="" method="POST" id="formcustomer" class="form">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="alert alert-danger" style="display:none"></div>
                    <div class="alert alert-success" style="display:none"></div>
                    <input type="hidden" name="oldusername" id="oldusername">

                    <input type="text" id="idMobil" name="idMobil" hidden />

                    <div class="form-group">
                        <label>Merk Mobil</label>
                        <input type="text" class="form-control" placeholder="Merk Mobil" id="merkMobil" name="merkMobil">
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
                                <label>Tahun</label>
                                <input id="tahun" type="number" class="form-control" name="tahun">
                            </div>
                        </div>


                    </div>

                    <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Nopol</label>
                                <input id="noPol" type="text" class="form-control" name="noPol">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Gambar Mobil </label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="gambar" name="gambar">
                                    <label class="custom-file-label" for="customFile">Pilih file</label>
                                </div>
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
@endsection


@section('script')
<script src="{{ asset('/js/tampilan/fileinput.js') }}"></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTablesBootstrap4.js') }}"></script>
<script src="{{ asset('/js/Master/mobil.js') }}"></script>
<script src="{{ asset ('/js/moment-with-locales.js')}}"></script>




@endsection
