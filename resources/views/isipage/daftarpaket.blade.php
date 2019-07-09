<div class="row pt-3">
    <input type="text" id="noTrans" name="noTrans" hidden value="{{noTrans_otomatis(auth()->user()->idCustomer)}}">
    @foreach($daftarpaket as $dp)
    <div class="col-md-4 mb-4">
        <div class="kartuproduk rounded">
            <div class="itemkartugambar p-2">
                <img src="{{asset ('/assets/gambar/'.$dp->typeMobil.'.png')}}" alt="">
            </div>

            <div class="itemkartukonten p-2">
                <a class="d-block font-weight-bold" style="font-size: 18px"> {{$dp->namaPaket}}</a>
                <a class="d-block"> {{$dp->typeMobil}}</a>
                <a class="d-block"> Jadwal {{$dp->jadwalBuka}} - {{$dp->jadwalTutup}} </a>
                <a class="d-block text-dark font-weight-bold"> Rp. {{$dp->harga}} </a>
            </div>
            <div class="itemtombolkonten  p-2">
                <button class="btn btn-sm btn-outline-dark" @if (auth()->check()) onclick="btnKonfr('{{$dp->idPaket}}','{{$dp->harga}}')" @else onclick="btnLogindulu()" @endif style="width: 100%;height: 100%">Pesan Sekarang</button>
            </div>
        </div>
    </div>
    @endforeach
</div>


<script>
    function btnKonfr(idPaket, harga) {
        var noTrans = $("#noTrans").val();
        var idCustomer = $("#idCustomer").val();
        var fullDate = new Date();
        var twoDigitMonth = ((fullDate.getMonth().length + 1) === 1) ? (fullDate.getMonth() + 1) : '0' + (fullDate.getMonth() + 1);
        var tanggal = fullDate.getFullYear() + "-" + twoDigitMonth + "-" + fullDate.getDate();

        var fullDateBatas = new Date(fullDate);
        fullDateBatas.setDate(fullDate.getDate() + 3);
        var twoDigitMonthBatas = ((fullDateBatas.getMonth().length + 1) === 1) ? (fullDateBatas.getMonth() + 1) : '0' + (fullDateBatas.getMonth() + 1);
        var batasPembayaran = fullDateBatas.getFullYear() + "-" + twoDigitMonthBatas + "-" + fullDateBatas.getDate();

        Swal.fire({
            title: "Konfirmasi",
            text: "Apakah anda yakin?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya!',
            cancelButtonText: 'Tidak!'
        }).then((result) => {
            if (result.value) {
                $.ajax({

                    type: "POST",
                    url: "/insertPesanan",
                    data: {
                        'noTrans': noTrans,
                        'idPaket': idPaket,
                        'idCustomer': idCustomer,
                        'harga': harga,
                        'batasPembayaran': batasPembayaran,
                        'tanggal': tanggal,
                    },
                    cache: false,
                    success: function(response) {
                        tampilPesanan();
                        Swal.fire({
                            position: 'top-end',
                            type: 'success',
                            title: 'Pesanan anda berhasil',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    },
                    failure: function(response) {

                        Swal.fire({
                            type: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',
                        })
                    }
                });
            }
        });
    }

    function btnLogindulu() {
        Swal.fire({
            type: 'error',
            title: 'Maaf',
            text: 'Silahkan login dulu sebelum melakukan transaksi',
        })


    }
</script>
