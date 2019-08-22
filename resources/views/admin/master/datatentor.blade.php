@extends('admin.master')

@section('judul')
Data Tentor
@endsection

@section('content')


<!-- Button to Open the Modal -->

<section class="mb-5">
    <div class="pt-3">
        <button id="btnTambah" type="button" class="btn btn-primary btn box-tools pull-left" data-toggle="modal" data-target="#modalTambahTentor">
            <i class="fa fa-plus-circle" aria-hidden="true"></i>
        </button>
        <div class="pull-right">
            <input id="caridata" type="text" class="form-control" name='caridata' onkeyup="showData()" />
        </div>
        <label class="pull-right mt-2"> Cari &nbsp;</label>
    </div>

</section>

<div id="tabelDisini"></div>

</div>


<!--Srart Modal -->
<div class="modal fade" id="modalTambahTentor">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Tentor</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form method="POST" id="insertform" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="alert alert-danger" style="display:none"></div>
                    <div class="alert alert-success" style="display:none"></div>
                    <input type="text" id="idTentor" name="idTentor" hidden />

                    <div class="form-group">
                        <label>Nama Tentor</label>
                        <input type="text" class="form-control" placeholder="Nama Tentor" id="namaTentor" name="namaTentor">
                    </div>


                    <div class="form-group ">
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
                            <input type="file" class="custom-file-input" id="urlFoto" name="urlFoto">
                            <label class="custom-file-label" for="customFile">Pilih file</label>
                        </div>
                    </div>

                    <div class="text-right">
                        <button id="btnSimpan" type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp; Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- EndModal -->


<!--Srart Modal -->
<div class="modal fade" id="modalEditTentor" enctype="multipart/form-data">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="form-group mb-0">
                    <label>Edit Tentor</label>
                </div>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form method="post" id="editform">
                <div class="modal-body" id="wadahEditTentor">

                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('/css/bootstrap-datepicker.min.css')}}">
@endsection


@section('script')
<script src="{{ asset('/js/tampilan/fileinput.js') }}"></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap-datepicker.min.js') }}"></script>
<script>
    $(function() {
        $(".datepicker").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
        });
    });
</script>
<script type="text/javascript">
    function showData() {
        var caridata = $("#caridata").val();

        $.ajax({
            type: 'GET',
            url: '/admin/tentor/showTentor',
            data: {
                caridata: caridata,
                state: 'master',
            },
            success: function(response) {

                $("#tabelDisini").html(response.html);
            },
            error: function(response) {
                alert('gagal \n' + response.responseText);
            }
        });
    }

    function showEditData(id) {

        $.ajax({
            type: 'GET',
            url: '/admin/tentor/showEditTentor',
            data: {
                id: id,
            },
            success: function(response) {

                $("#wadahEditTentor").html(response.html);
            },
            error: function(response) {
                alert('gagal \n' + response.responseText);
            }
        });
    }

    $('#insertform').on('submit', function(event) {
        event.preventDefault();
        var namaTentor = $('#namaTentor').val();
        var tanggalLahir = $('#tanggalLahir').val();
        var biodata = $('#biodata').val();
        var foto = $('#foto').val();
        if (namaTentor != '' && tanggalLahir != '' && biodata != '') {
            $.ajax({
                method: 'post',
                url: "/admin/tentor/simpanTentor",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    $('#modalTambahTentor').modal('toggle');
                    Swal.fire({
                        type: 'success',
                        title: 'data Tentor Berhasil di Masukan',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    showData();

                }
            });
        } else {
            Swal.fire({
                type: 'error',
                title: 'Gagal memasukan data, cek kembali data anda',
                showConfirmButton: false,
                timer: 1500
            });
        }
    });

    $('#editform').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            method: 'post',
            url: "/admin/tentor/editTentor",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $('#modalEditTentor').modal('toggle');
                Swal.fire({
                    type: 'success',
                    title: 'data Tentor Berhasil di Ubah',
                    showConfirmButton: false,
                    timer: 1500
                })
                showData();

            }
        });
    });

    function deleteData(id) {
        Swal.fire({
            title: 'Anda yakin?',
            text: "data ini akan di hapus!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus saja!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'DELETE',
                    url: '/admin/tentor/deleteData',
                    data: {
                        idTentor: id,
                    },
                    success: function(response) {

                        Swal.fire(
                            'Deleted!',
                            'Data berhasil di hapus',
                            'success'
                        )
                        showData();
                    },
                    error: function(response) {
                        alert('gagal \n' + response.responseText);
                    }
                });
            }
        })
    }

    $(window).on("load", function() {
        showData();
    });
</script>



@endsection
