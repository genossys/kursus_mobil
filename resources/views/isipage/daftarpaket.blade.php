<div class="row pt-3">
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
                <a class="d-block text-dark font-weight-bold"> Rp. {{$dp->harga}}  </a>
            </div>
            <div class="itemtombolkonten  p-2">
                <button class="btn btn-sm btn-outline-dark" style="width: 100%;height: 100%">Pesan Sekarang</button>
            </div>
        </div>
    </div>
    @endforeach
</div>
