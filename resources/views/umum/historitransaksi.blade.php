@extends('umum.master')
@section('content')

<section class="history" style="min-height: 500px; z-index: 9">
    <h5 class="text-left text-info pt-3"> Berikut adalah daftar transaksi anda </h5>
    <div id="tampilanhistorybelanja">

    </div>
</section>

<!--Srart Modal -->
<div class="modal fade" id="modalDetailTransaksi">
    <div class="modal-dialog modal-lg">

        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Detail Transaksi</h6>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body" id="dataModalDetail">

            </div>
        </div>
    </div>
</div>
<!-- EndModal -->
@endsection


@section('footer')
<section>
    <footer>
        <div class="footer">
            &copy; Copyright 2019
        </div>
    </footer>
</section>
@endsection


@section('css')

@endsection

@section('script')
<script>
    function tampilTransaksi() {

        var username = "";

        $.ajax({
            type: 'GET',
            url: '/tampilTransaksiUser',
            data: {
                username: username,
            },
            success: function(data) {
                $("#tampilanhistorybelanja").html(data.html);
            }
        });
    }

    function tampilDetailTransaksi(noTrans) {


        $.ajax({
            type: 'GET',
            url: '/pesananadmin',
            data: {
                noTrans: noTrans,
            },
            success: function(data) {
                $("#dataModalDetail").html(data.html);
            }
        });
    }

    $(window).on("load", function() {
        tampilTransaksi();
    });
</script>
@endsection
