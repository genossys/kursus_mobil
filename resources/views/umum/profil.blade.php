@extends('umum.master')
@section('content')

<!-- peta -->
<section class="mt-2 pt-3 pb-3">
    <div class="row">
        <div class="col-md-5">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1398.3563603950731!2d110.8201540456673!3d-7.558721476587386!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a168ffa6f1a81%3A0xe602d92878081ef9!2sKursus+Setir+Gajahmada+Baru!5e0!3m2!1sen!2sid!4v1566021793480!5m2!1sen!2sid" width="400" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
        <div class="col-md-7">
            <h2>Gajah Mada Baru</h2>
            <p style="margin: 0">Jl. Hasanudin No. 139 Punggawan, Banjarsari, Solo</p>
            <p style="margin: 0">Telp. (0271) 728872 / 081 667 4239</p>
        </div>
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
