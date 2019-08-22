@extends('admin.master')

@section('judul')
Data Mobil
@endsection

@section('content')


<!-- Button to Open the Modal -->
<!-- Button to Open the Modal -->
<section class="mb-5">
    <div class="pt-3">
        <button id="btnTambah" type="button" class="btn btn-primary btn box-tools pull-left" data-toggle="modal" data-target="#modalTambahMobil">
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
<div class="modal fade" id="modalTambahMobil">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Mobil</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form action="" method="POST" id="insertform" class="mobilForm" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="alert alert-danger" style="display:none"></div>
                    <div class="alert alert-success" style="display:none"></div>
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
                                    <input type="file" class="custom-file-input" id="urlFoto" name="urlFoto">
                                    <label class="custom-file-label" for="customFile">Pilih file</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-right">
                        <button id="btnSimpan" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp; Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- EndModal -->

<!--Srart Modal -->
<div class="modal fade" id="modalEditMobil" enctype="multipart/form-data">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="form-group mb-0">
                    <label>Edit Mobil</label>
                </div>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form method="post" id="editform">
                <div class="modal-body" id="wadahEditMobil">

                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('css')
@endsection


@section('script')
<script src="{{ asset('/js/tampilan/fileinput.js') }}"></script>

<script>
    function showData() {
        var caridata = $("#caridata").val();

        $.ajax({
            type: 'GET',
            url: '/admin/mobil/showMobil',
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
            url: '/admin/mobil/showEditMobil',
            data: {
                id: id,
            },
            success: function(response) {

                $("#wadahEditMobil").html(response.html);
            },
            error: function(response) {
                alert('gagal \n' + response.responseText);
            }
        });
    }

    $('#insertform').on('submit', function(event) {
        event.preventDefault();
        var merkMobil = $('#merkMobil').val();
        var tahun = $('#tahun').val();
        var nopol = $('#noPol').val();
        var gambar = $('#gambar').val();
        if (merkMobil != '' && tahun != '' && nopol != '') {
            $.ajax({
                method: 'post',
                url: "/admin/mobil/simpanMobil",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    $('#modalTambahMobil').modal('toggle');
                    Swal.fire({
                        type: 'success',
                        title: 'Data mobil berhasil di masukan',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    showData();

                },
                error: function(response) {
                    alert(response.responseText);
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
            url: "/admin/mobil/editMobil",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $('#modalEditMobil').modal('toggle');
                Swal.fire({
                    type: 'success',
                    title: 'data Mobil Berhasil di Ubah',
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
                    url: '/admin/mobil/deleteData',
                    data: {
                        idMobil: id,
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
