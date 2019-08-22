<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gajah Mada</title>
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css?family=Ubuntu:400,700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset ('adminlte/plugins/font-awesome/css/font-awesome.min.css')}}">

    <!-- Styles -->
    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/slick/slick.css') }}" rel="stylesheet" />
    <link href="{{ asset('/slick/slick-theme.css') }}" rel="stylesheet" />
    <link href="{{ asset('/css/genosstyle.css') }}" rel="stylesheet" />

</head>

<body class="bodypolos">
    <nav class="navbar navbarfont navbar-expand-lg navbar-inverse navbar-dark fixed-top home pl-5" style="background-color: rgba(0, 0, 0, 0)">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span id="toggler"><i class="fa fa-bars" aria-hidden="true"></i></span>
        </button>
        <a class="navbar-brand" href="#">
            <!-- <img src="{{ asset('/assets/gambar/logo2.png') }} " alt="logo" /> -->
        </a>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav mr-auto mt-2 mt-sms-0  ">
                <li class="nav-item pl-4">
                    <a id="home" class="nav-link" href="/">Home </a>
                </li>

                <li class="nav-item pl-4">
                    <a class="nav-link" href="{{route('paket')}}">Paket</a>
                </li>

                <li class="nav-item pl-4">
                    <a class="nav-link" href="/profil">Profil</a>
                </li>

                @if (auth()->check())

                @if (auth()->user()->hakAkses == 'admin' || auth()->user()->hakAkses == 'pimpinan')
                <li class="nav-item ml-4">
                    <a class="nav-link" href="{{route('admin')}}">Dashboard</a>
                </li>
                @endif

                <li class="nav-item dropdown ml-4">
                    @if(sisaKeranjang(auth()->user()->username) != 0)
                    <span class="badge badge-danger" style="float:right;margin-bottom:-10px">{{sisaKeranjang(auth()->user()->username)}}</span>
                    @endif
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        {{auth()->user()->username}}
                        <i class="fa fa-user"></i>
                        <span class="sr-only">(current)</span>

                    </a>
                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                        <a href="/keranjangPesanan" class="dropdown-item dropdown-footer">Keranjang
                            @if(sisaKeranjang(auth()->user()->username) != 0)
                            <span class="badge badge-danger">{{sisaKeranjang(auth()->user()->username)}}</span>
                            @endif
                        </a>
                        <a href="{{route('historyTransaksi')}}" class="dropdown-item dropdown-footer">History Belanja</a>
                        <a href="{{route('jadwalKursus')}}" class="dropdown-item dropdown-footer">Jadwal Kursus</a>
                        <hr>
                        <a href="{{route('logout')}}" class="dropdown-item dropdown-footer">Logout</a>
                    </div>
                </li>
                @else
                <li class="nav-item ml-4">
                    <a class="nav-link" href="/login">
                        Login
                        <i class="fa fa-user"></i>
                    </a>
                </li>
                @endif

            </ul>
        </div>
    </nav>

    <section class="gambarfullhome">

        <div class="bgtekshome">

            <div class="tekshome">
                <h1 class="judulhome anJudul">
                    Kursus Mobil Terpercaya
                </h1>

                <p class="isihome anIsi">
                    Daftar Kursus Mobil Secara Online
                </p>

                <a class="btn btn-danger btn-lg anBtn" href="{{route('paket')}}">Lihat Paket</a>
            </div>
        </div>
    </section>

    <section class="visimisi">
        <div class="row p-5 text-center">
            <div class="col-md-4">
                <img src="{{ asset('/images/tentorberpengalaman.png')}}" alt="" style="width: 100px; height:100px">
                <p class="mt-3" style="font-size: 20px">Tentor Berpengalaman</p>
                <p class="text-center">Gajah Mada Baru mempunyai tentor yang berpengalaman dari berbagai daerah, anda bisa request tentor yang tersedia di Gajah Mada Baru Surakarta</p>
            </div>

            <div class="col-md-4">
                <img src="{{ asset('/images/mobilbanyak.png')}}" alt="" style="width: 100px; height:100px">
                <p class="mt-3" style="font-size: 20px">Banyak Pilihan Mobil</p>
                <p class="text-center">Gajah Mada Baru mempunyai berbagai pilihan mobil yang berkualitas, anda bisa request mobil yang tersedia di Gajah Mada Baru Surakarta</p>
            </div>

            <div class="col-md-4">
                <img src="{{ asset('/images/transaksimudah.png')}}" alt="" style="width: 100px; height:100px">
                <p class="mt-3" style="font-size: 20px">Transaksi Mudah</p>
                <p class="text-center">Gajah Mada Baru mempunyai menyediakan pemesanan kursus mobil secara online</p>
            </div>
        </div>
    </section>

    <section class="tentorKami">
        <div class="w-100 text-center">
            <h4 class="d-inline text-dark rounded p-2" style="background-color: rgba(200, 200, 200, 1)">Tentor Kami</h4>
        </div>
        <div class="p-5 ">
            <div class="variable-width" style="100px">
                @foreach($tentor as $t)
                <div class="mr-2 ml-2">
                    <img src="{{ asset('/tentor/'.$t->foto)}}" alt="" style="width: 300px; height: 300px; object-fit: cover">
                    <div style="width: 300px;height: 300px;padding: 20px; background-color: rgba(200, 200, 200, 1)" class="rounded">
                        <p style="font-size: 20px">{{$t->namaTentor}}</p>
                        <p class="text-justify">{{$t->biodata}}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="mobilKami">
        <div class="w-100 text-center">
            <h4 class="d-inline text-dark rounded p-2" style="background-color: rgba(255, 255, 255, 1)">Mobil Kami</h4>
        </div>

        <div class="p-5 ">
            <div class="variable-width" style="100px">
                @foreach($mobil as $m)
                <div class="mr-2 ml-2">
                    <img src="{{ asset('/mobil/'.$m->gambar)}}" alt="" style="width: 300px; height: 300px; object-fit: cover">
                    <div style="width: 300px;height: 170px;padding: 20px; background-color: rgba(255, 255, 255, 1)" class="rounded">
                        <p style="font-size: 20px">{{$m->merkMobil}}</p>
                        <p class="text-justify m-0 p-0">Type: {{$m->typeMobil}}</p>
                        <p class="text-justify m-0 p-0">Tahun: {{$m->tahun}}</p>
                        <p class="text-justify m-0 p-0">Nopol: {{$m->noPol}}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>


    <section>
        <footer>
            <div class="footer">
                &copy; Copyright 2019
            </div>
        </footer>
    </section>

    <!-- JS -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/slick/slick.js') }}"></script>
    <script src="{{ asset('/js/tampilan/genosstyle.js') }}"></script>

    <script>
        $('.variable-width').slick({
            dots: true,
            infinite: false,
            speed: 300,
            slidesToShow: 1,
            centerMode: true,
            variableWidth: true,
            arrows: true
        });
    </script>
</body>
