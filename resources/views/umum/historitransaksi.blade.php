@extends('umum.master')
@section('content')

<section class="history" style="min-height: 500px; z-index: 9">
    <h5 class="text-left text-info pt-3"> Berikut adalah daftar transaksi anda </h5>
    <div id="tampilanhistorybelanja">

    </div>
</section>
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

        var idCustomer = $("#idCustomer").val();

        $.ajax({
            type: 'GET',
            url: '/tampilTransaksi',
            data: {
                idCustomer: idCustomer,
            },
            success: function(data) {
                $("#tampilanhistorybelanja").html(data.html);
            }
        });
    }

    $(window).on("load", function() {
        tampilTransaksi();
    });
</script>
@endsection
