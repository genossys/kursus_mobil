@extends('umum.master')
@section('content')

<section class="isipaket" style="min-height: 500px; z-index: 9">

    <div class="pencarian pt-2">
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="mb-0">Type Mobil</label>
                    <select class="form-control" onchange="pencarianmenu()" id="typeMobil" name="typeMobil">
                        <option value="">Semua</option>
                        <option value="auto">Auto</option>
                        <option value="manual">Manual</option>
                        <option value="kombinasi">Kombinasi</option>
                    </select>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <label class="mb-0">Jadwal</label>
                    <select class="form-control" id="jadwal" name="jadwal" onchange="pencarianmenu()">
                        <option value="">Semua</option>
                        <option value="07:00:00">07.00 - 17.00 (Reguler)</option>
                        <option value="18:00:00">18.00 - 19.00 (Malam)</option>
                    </select>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <label class="mb-0">Pertemuan</label>
                    <select class="form-control" id="pertemuan" name="pertemuan" onchange="pencarianmenu()">
                        <option value="">Semua</option>
                        <option value="3"> 3x</option>
                        <option value="4"> 4x</option>
                        <option value="5"> 5x</option>
                        <option value="6"> 6x</option>
                        <option value="7"> 7x</option>
                        <option value="8"> 8x</option>
                        <option value="9"> 9x</option>
                        <option value="10"> 10x</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <section id="daftarPaket">

    </section>
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


@section('script')
<script src="{{ asset('/js/tampilan/genosstyle.js') }}"></script>

<script>
    function pencarianmenu() {

        var typeMobil = $('#typeMobil').val();
        var jadwalBuka = $('#jadwal').val();
        var kaliPertemuan = $('#pertemuan').val();
        $.ajax({
            type: 'GET',
            url: '/caripaket',
            data: {
                typeMobil: typeMobil,
                jadwalBuka: jadwalBuka,
                kaliPertemuan: kaliPertemuan,
            },
            success: function(data) {
                $("#daftarPaket").html(data.html);
            }
        });
    }

    $(window).on("load", function() {
        pencarianmenu();
    });
</script>
@endsection
