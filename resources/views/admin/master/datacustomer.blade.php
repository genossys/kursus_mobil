@extends('admin.master')

@section('judul')
Data Customer
@endsection

@section('content')


<!-- Button to Open the Modal -->

<div class="pt-4">

    <button id="tambahModal" type="button" class="btn btn-primary pull-left" onclick="showTambahCustomer()">
        <span><i class="fa fa-plus-circle" aria-hidden="true"></i></span>
    </button>

</div>

<div class="table-responsive-lg">
    <table id="example2" class="table table-striped  table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Username</th>
                <th>Email</th>
                <th>No. Telp</th>
                <th>Alamat</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>

</div>


<!--Srart Modal -->
<div class="modal fade" id="modalCustomer">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Customer</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form action="" method="POST" id="formcustomer" class="form">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="alert alert-danger" style="display:none"></div>
                    <div class="alert alert-success" style="display:none"></div>
                    <input type="hidden" name="oldusername" id="oldusername">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" placeholder="Username" id="username" name="username">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Email </label>
                                <input type="email" class="form-control" placeholder="Email" id="email" name="email">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Alamat </label>
                        <input type="text" class="form-control" placeholder="Alamat" id="alamat" name="alamat">
                    </div>
                    <div class="form-group">
                        <label>No.Telp </label>
                        <input type="text" class="form-control" placeholder="No. Hp" id="nohp" name="nohp">
                    </div>

                    <div class="form-group">
                        <label>{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    </div>

                    <div class="form-group">
                        <label>{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>

                    <div class="text-right">
                        <button id="btnSimpan" class="btn btn-primary"><i id="iconbtn" class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;</button>
                    </div>
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
<script src="{{ asset('/js/Master/customer.js') }}"></script>
@endsection
