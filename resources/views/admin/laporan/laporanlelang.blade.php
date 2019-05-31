@extends('admin.master')

@section('judul')
Laporan Data Lelang
@endsection

@section('content')


<!-- Button to Open the Modal -->
<section class="pencarianlap">
    <!-- Date and time range -->
    <div class="container">
        <div class="row">
            <div class="col-sm-5 ">
        <div class="form-group">
            <label>Tanggal Lelang:</label>

            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                </div>
                <input type="text" class="form-control float-right" id="reservation">
                <button class="btn btn-success"><i class="fa fa-search" aria-hidden="true"></i></button>
            </div>
            </div>
            </div>
        </div>
        <!-- /.input group -->
    </div>
    <!-- /.form group -->

    <!-- Date and time range -->

</section>

<section>
    <div class="container">
        <div class="table-responsive-lg">
            <table id="example2" class="table table-striped  table-bordered table-hover" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ID tahapan</th>
                        <th>ID Lelang</th>
                        <th>Batas Waktu Upload</th>
                        <th>Pekerjaan</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</section>

@endsection

@section('css')
<!-- daterange picker -->
<link rel="stylesheet" href="{{ asset('/adminlte/plugins/daterangepicker/daterangepicker-bs3.css')}}">
@endsection


@section('script')
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="{{asset ('adminlte/plugins/daterangepicker/daterangepicker.js')}}"></script>
<script>
$(function () {
    //Date range picker
    $('#reservation').daterangepicker()

})
</script>

@endsection
