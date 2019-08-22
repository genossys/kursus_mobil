@extends('umum.master')
@section('content')
<div class=" pt-3"></div>
<div class="">
    @foreach($data as $dt)
    <div class="container pt-3 pb-3" style="background-color: RGBA(200,200,200,0.4)">
        <div class="notransaksi">No. Transaksi : {{ $dt->noTrans }}</div>
        <div class="tgltransaksi">Tanggal : {{ $dt->tanggal }}</div>

        <div>Detail Pembayaran</div>

        <div class="container">
            <div class="row text-center" style="background: grey; font-weight: bolder;">
                <div class="col-sm-10">Description</div>
                <div class="col-sm-2">Total</div>
            </div>
            <hr>

            <div class="row">
                <div class="col-sm-9">Total Biaya</div>
                <div class="col-sm-1 text-right">Rp. </div>
                <div class="col-sm-2 text-right">{{ formatuang($dt->total) }}</div>
            </div>

            <hr>
            <p style="font-weight: 700"> Upload Bukti Transfer dan Alamat pengiriman:</p>
            <form method="post" id="formbayar" enctype="multipart/form-data">
                <input hidden value="{{ $dt->noTrans }}" id="noTrans" name="noTrans">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="bank">BANK</label>
                            <select id="bank" class="form-control" name="bank">
                                <option value="BCA">BCA</option>
                                <option value="BRI">BRI</option>
                                <option value="BNI">BNI</option>
                                <option value="MANDIRI">MANDIRI</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Bukti Transfer </label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="urlFoto" name="urlFoto">
                                <label class="custom-file-label" for="customFile">Pilih file</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg" id="btnSimpan">Konfirmasi Pembayaran</button>
                        </div>
                    </div>

                </div>
            </form>

        </div>

        <p>Pembayaran akan di cek dalam 24 jam setelah bukti transfer di upload. </p>
        <hr>
        <p style="font-weight: 700"> Cara Pembayaran:</p>
        <p> 1. Gunakan ATM / iBanking / Setor Tunai untuk transfer ke rekening NAJWA COLLECTION berikut ini</p>
        <div class="rekening pl-2 pt-1">
            <p class="mb-0"> Bank: BCA</p>
            <p class="mb-0"> No Rekening: 73178238</p>
            <p class="mb-0"> Cabang: Solo</p>
            <p class="mb-1 pb-2"> Nama Rekening: --------</p>
            <br>
            <p class="mb-0"> Bank: BRI</p>
            <p class="mb-0"> No Rekening: 73178238</p>
            <p class="mb-0"> Cabang: Solo</p>
            <p class="mb-1 pb-2"> Nama Rekening: --------</p>
            <br>
            <p class="mb-0"> Bank: BNI</p>
            <p class="mb-0"> No Rekening: 73178238</p>
            <p class="mb-0"> Cabang: Solo</p>
            <p class="mb-1 pb-2"> Nama Rekening: --------</p>
            <br>
            <p class="mb-0"> Bank: MANDIRI</p>
            <p class="mb-0"> No Rekening: 73178238</p>
            <p class="mb-0"> Cabang: Solo</p>
            <p class="mb-1 pb-2"> Nama Rekening: --------</p>
            <br>
        </div>
        <p> 2. Silahkan upload bukti Pembayaran sebelum tanggal --------</p>
        <p> 3. Demi kenyamanan transaksi, mohon untuk tidak membagikan bukti atau konfirmasi pembayaran pesanan
            kepada siapapun selain mengunggahnya ke website Gajah Mada
        </p>
        <hr>

    </div>
    @endforeach
</div>

</div> @endsection @section('footer') <section>
    <footer>
        <div class="footer">
            &copy; Copyright 2019
        </div>
    </footer>
</section>
@endsection


@section('script')
<script src="{{ asset('/js/tampilan/genosstyle.js') }}"></script>
<script src="{{ asset('js/tampilan/fileinput.js') }}"></script>

<script>
    $('#formbayar').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            method: 'post',
            url: '/insertPembayaran',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                var noTrans = $("#noTrans").val();
                var status = "menunggu";

                $.ajax({
                    type: 'POST',
                    url: '/updateStatusPembayaran',
                    data: {
                        noTrans: noTrans,
                        status: status,
                    },
                    success: function(response) {

                        Swal.fire({
                            type: 'success',
                            title: 'Bukti Pembayaran anda akan segera kami konfirmasi',
                            showConfirmButton: false,
                            timer: 1500
                        })

                        window.location.href = "{{URL::to('/historyTransaksi')}}"
                    },
                    error: function(response) {
                        alert('gagal \n' + response.responseText);
                    }
                });

            }
        });
    });
</script>
@endsection
