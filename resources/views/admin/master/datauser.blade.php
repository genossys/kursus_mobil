@extends('admin.master')

@section('judul')
Data User
@endsection

@section('content')


<!-- Button to Open the Modal -->
<div class="pt-4">

    <button id="tambahModal" type="button" class="btn btn-primary pull-left" onclick="showTambahUser()">
        <span><i class="fa fa-plus-circle" aria-hidden="true"></i></span>
    </button>

</div>

<div class="table-responsive-lg">
    <table id="example2" class="table table-striped  table-bordered table-hover nowrap" cellspacing="0" width="100%" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Username</th>
                <th>Email</th>
                <th>Hak Akses</th>
                <th>No. Telp</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>

<!--Srart Modal -->
<div class="modal fade" id="modaltambahUser">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data User</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form action="" method="POST" id="formSimpanUser" class="formuser">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="alert alert-danger" style="display:none"></div>
                    <div class="alert alert-success" style="display:none"></div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="username">{{ __('Username') }}</label>
                                <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="email">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Hak Akses</label>
                                <select class="form-control" id="cBoxHakAkses" name="hakAkses">
                                    <option value="admin">Admin</option>
                                    <option value="pimpinan">Pimpinan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="nohp">{{ __('No. Hp') }}</label>
                                <input id="nohp" type="text" class="form-control" name="nohp" value="{{ old('nohp') }}" required autocomplete="nohp">
                            </div>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="password">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
                            </div>
                        </div>


                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="password-confirm">{{ __('Konfirmasi Password') }}</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                    </div>

                    <div class="text-right">
                        <button id="btnSimpan" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;Simpan</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="modalEditUser">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Edit Data User</h6>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form action="" method="POST" id="formEditUser" class="formuser">
                <div class="modal-body">
                    <div class="alert alert-danger" style="display:none">coba</div>
                    <div class="alert alert-success" style="display:none"></div>
                    <input type="hidden" name="oldusername" id="oldusername">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="usernameedit">{{ __('Username') }}</label>
                                <input id="usernameedit" type="text" class="form-control" name="usernameedit" value="{{ old('usernameedit') }}" required autocomplete="usernameedit" autofocus>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="emailedit">{{ __('E-Mail Address') }}</label>
                                <input id="emailedit" type="email" class="form-control" name="emailedit" value="{{ old('emailedit') }}" required autocomplete="emailedit">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Hak Akses</label>
                                <select class="form-control" id="cBoxHakAksesedit" name="hakAksesedit">
                                    <option value="admin">Admin</option>
                                    <option value="pimpinan">Pimpinan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="nohpedit">{{ __('No. Hp') }}</label>
                                <input id="nohpedit" type="text" class="form-control" value="{{ old('nohpedit') }}" name="nohpedit" required autocomplete="nohpedit">
                            </div>
                        </div>
                    </div>
                </div>

                    <div class="text-right">
                        <button id="btnEdit" class="btn btn-primary">Update</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="modalEditPassword">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Reset Password</h6>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form action="" method="POST" id="formEditPsw" class="formuser">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="alert alert-danger" style="display:none">coba</div>
                    <div class="alert alert-success" style="display:none"></div>
                    <input type="hidden" name="oldusernamepsw" id="oldusernamepsw">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="passwordedit">{{ __('Password') }}</label>
                                <input id="passwordedit" type="password" class="form-control" name="passwordedit" required autocomplete="new-password">
                            </div>
                        </div>
                    </div>


                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="passwordedit-confirm">{{ __('Confirm Password') }}</label>
                                <input id="passwordedit-confirm" type="password" class="form-control" name="passwordedit_confirmation" required autocomplete="new-password">
                                <small id="passwordHelpEdit" class="text-danger" hidden>
                                    Password Tidak Cocok
                                </small>
                            </div>
                        </div>
                    </div>

                    <div class="text-right">
                        <button id="btnEditPsw" class="btn btn-primary">Update</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>


@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('/css/dataTables.bootstrap4.min.css')}}">

@endsection


@section('script')
<script src="{{ asset('/js/tampilan/fileinput.js') }}"></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTablesBootstrap4.js') }}"></script>
<script src="{{ asset('/js/Master/user.js') }}"></script>
<script type="text/javascript">
$("#passwordedit-confirm").on("blur", function () {
    var psw = document.getElementById("passwordedit").value;
    var pswcnf = document.getElementById("passwordedit-confirm").value;
    if ((psw == pswcnf)) {
        $("#passwordHelpEdit").attr("hidden", true);
    } else {
        $("#passwordHelpEdit").attr("hidden", false);
    }
});</script>

@endsection
