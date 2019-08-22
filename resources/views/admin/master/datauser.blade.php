@extends('admin.master')

@section('judul')
Data User
@endsection

@section('content')


<section class="mb-5">
    <div class="pt-3">
        <button id="btnTambah" type="button" class="btn btn-primary btn box-tools pull-left" data-toggle="modal" data-target="#modalTambahUser">
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
<div class="modal fade" id="modalTambahUser">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data User</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form action="" method="POST" id="insertform">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="alert alert-danger" style="display:none"></div>
                    <div class="alert alert-success" style="display:none"></div>
                    <div class="form-group">
                        <label for="username">{{ __('Username') }}</label>
                        <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                    </div>
                    <div class="form-group">
                        <label for="email">{{ __('E-Mail Address') }}</label>
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email">
                    </div>
                    <div class="form-group">
                        <label>Hak Akses</label>
                        <select class="form-control" id="cBoxHakAkses" name="hakAkses">
                            <option value="admin">Admin</option>
                            <option value="pimpinan">Pimpinan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nohp">{{ __('No. Hp') }}</label>
                        <input id="nohp" type="text" class="form-control" name="nohp" value="{{ old('nohp') }}" required autocomplete="nohp">
                    </div>
                    <div class="form-group">
                        <label for="password">{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
                    </div>
                    <div class="form-group">
                        <label for="password-confirm">{{ __('Konfirmasi Password') }}</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                    <div class="text-right">
                        <button id="btnSimpan" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!--Srart Modal -->
<div class="modal fade" id="modalEditUser" enctype="multipart/form-data">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="form-group mb-0">
                    <label>Edit User</label>
                </div>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form method="post" id="editform">
                <div class="modal-body" id="wadahEditUser">

                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('css')
@endsection


@section('script')
<script>
    function showData() {
        var caridata = $("#caridata").val();

        $.ajax({
            type: 'GET',
            url: '/admin/user/showUser',
            data: {
                caridata: caridata,
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
            url: '/admin/user/showEditUser',
            data: {
                id: id,
            },
            success: function(response) {

                $("#wadahEditUser").html(response.html);
            },
            error: function(response) {
                alert('gagal \n' + response.responseText);
            }
        });
    }

    $('#insertform').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            method: 'post',
            url: "/admin/user/simpanUser",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $('#modalTambahUser').modal('toggle');
                Swal.fire({
                    type: 'success',
                    title: 'data User Berhasil di Masukan',
                    showConfirmButton: false,
                    timer: 1500
                })
                showData();

            }
        });
    });

    $('#editform').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            method: 'post',
            url: "/admin/user/editUser",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $('#modalEditUser').modal('toggle');
                Swal.fire({
                    type: 'success',
                    title: 'data User Berhasil di Ubah',
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
                    url: '/admin/user/deleteData',
                    data: {
                        id: id,
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
