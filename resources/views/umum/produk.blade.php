@extends('umum.master')
@section('content')
<section class="newproduk">
    <div class="newprodukkon">
        <div class="row">
            <div class="col-sm-5 text-right">
                <img class="gambarnew img-fluid" src="{{asset ('/assets/gambar/tigerrollcake.png')}}" alt="{{asset ('/assets/gambar/tigerrollcake.png')}}">
            </div>
            <div class="col-sm-7">
                <h1> (Baru) Tiger Roll Cake </h1>
                <p>Cake kali ini sedikit beda dengan tampilan cake yang lain, agar tampilan lebih menarik dan unik cake ini dibuat motif dengan sentuhan aksen seperti warna macan tutul. Untuk memberi aksen motif seperti ini memang cukup membutuhkan keahlian dan ketelatenan.</p>
                <h2 style="color: black"> Rp. 50.000</h2>
                <div class="tombolpesan">
                    <button class="input-plus btn btn-primary">+</button><input class="inputjumlah form-control" type="text" value="0"><button class="input-min btn btn-primary">-</button>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="produkkami">
    <div class="container">
        <h3 class="text-center"> Snack Kami</h3>
        <hr class="judulsection">
        <div class="row">


            <div class="col-md-3">
                <div class="kartuproduk">
                    <img src="{{asset ('/assets/gambar/arem.jpg')}}" alt="" data-toggle="modal" data-target="#myModal">
                    <h3 data-toggle="modal" data-target="#myModal"> Arem-arem </h3>

                    <div class="tombolpesankecil text-left">
                        <h4> Rp 2.000</h4>
                    </div>
                    <div class="tombolpesankecil text-right">

                        <button class="input-plus btn btn-primary">+</button><input class="inputjumlah form-control" type="text" value="0"><button class="input-min btn btn-primary">-</button>
                    </div>
                </div>
            </div>


        </div>
    </div>
</section>

<section class="paketkami">
    <div class="container">
        <h3 class="text-center"> Paket Kami</h3>
        <hr class="judulsection">
        <div class="row">
            <div class="col-md-4">
                <div class="kartupaket">
                    <img src="{{asset ('/assets/gambar/paket1.jpg')}}" alt="">

                    <h3 class="namapaket"> Paket 1 </h3>

                    <p class="isipaket">Nasi uduk</p>
                    <p class="isipaket">Sop Matahari</p>
                    <p class="isipaket">Es Buah</p>

                    <div class="tombolpesanpaket">
                        <h4> Rp 2.000</h4>
                    </div>

                    <div class="tombolpesanpaket text-right">
                        <button class="input-plus btn btn-primary">Pesan Sekarang</button>
                    </div>
                </div>
            </div>

        </div>


    </div>



    <!-- Modal Detail Produk -->
    <div class="modal" id="myModal">
        <div class="modal-dialog modal-lg ">
            <div class="modal-content modalprodukdialog">

                <!-- Modal body -->
                <div class="modal-body modalprodukbody">
                <button style="padding-right: 10px" type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="jumbotron  modalproduk">
                        <div class="row">
                            <div class="col-sm-5 text-right">
                                <img class="gambarnew img-fluid" src="{{asset ('/assets/gambar/arem.jpg')}}" alt="{{asset ('/assets/gambar/arem.jpg')}}">
                            </div>
                            <div class="col-sm-7">
                                <h1> Arem arem </h1>
                                <p>Cake kali ini sedikit beda dengan tampilan cake yang lain, agar tampilan lebih menarik dan unik cake ini dibuat motif dengan sentuhan aksen seperti warna macan tutul. Untuk memberi aksen motif seperti ini memang cukup membutuhkan keahlian dan ketelatenan.</p>
                                <h2 style="color: black"> Rp. 2.000</h2>
                                <div class="tombolpesan">
                                    <button class="input-plus btn btn-primary">+</button><input class="inputjumlah form-control" type="text" value="0"><button class="input-min btn btn-primary">-</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
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
@endsection
