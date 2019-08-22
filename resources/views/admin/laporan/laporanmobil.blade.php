@extends('admin.master')

@section('judul')
Data Mobil
@endsection

@section('content')


<!-- Button to Open the Modal -->
<!-- Button to Open the Modal -->
<section class="mb-5">
    <div class="pt-3">
        <form class="form-inline pull-right" action="{{route('cetakMobil')}}" method="get" target="_blank">

            <div class="form-group mx-sm-3 mb-2">
                <label class="mt-2"> Cari &nbsp;</label>
                <input id="caridata" type="text" class="form-control" name='caridata' onkeyup="showData()" />
                <input id="state" hidden type="text" class="form-control" name='state' value="laporan" />
            </div>
            <button id="btnTambah" type="submit" class="btn btn-primary btn box-tools pull-left">
                <i class="fa fa-print" aria-hidden="true"></i>
            </button>
        </form>

</section>

<div id="tabelDisini"></div>

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
            url: '/admin/mobil/showMobil',
            data: {
                caridata: caridata,
                state: "laporan",
            },
            success: function(response) {

                $("#tabelDisini").html(response.html);
            },
            error: function(response) {
                alert('gagal \n' + response.responseText);
            }
        });
    }

    $(window).on("load", function() {
        showData();
    });
</script>


@endsection
