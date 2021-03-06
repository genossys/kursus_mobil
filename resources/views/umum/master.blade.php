<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gajah Mada Kursus</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Ubuntu:400,700&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles -->
    <link rel="stylesheet" href="{{asset ('adminlte/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{asset ('adminlte/plugins/font-awesome/css/font-awesome.min.css')}}">
    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/css/genosstyle.css') }}" rel="stylesheet" />
    <link href="{{ asset('/css/sweetalert2.min.css') }}" rel="stylesheet" />
    @yield('css')

</head>

<body>
    @if (auth()->check())
    <input value="{{auth()->user()->username}}" id="username" name="username" hidden>
    @endif

    <div class="wrapper">
        <nav class="navbar navbarfont navbar-expand-lg navbar-inverse navbar-light" style="height: 50px;background-color: rgba(255, 255, 255,1);">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span id="toggler"><i class="fa fa-bars" aria-hidden="true"></i></span>
            </button>
            <a class="navbar-brand" href="#">
                <a class="text-danger" style="font-size: 30px">GAJAH MADA BARU</a>
                <!-- <img src="{{ asset('/assets/gambar/logo2.png') }} " alt="logo" /> -->
            </a>

            <div class="collapse navbar-collapse " id="navbarTogglerDemo03">
                <ul class="navbar-nav mt-sms-0  ml-auto mr-5">
                    <li class="nav-item ml-4">
                        <a id="home" class="nav-link" href="/">Home </a>
                    </li>

                    <li class="nav-item ml-4">
                        <a class="nav-link" href="{{route('paket')}}">Paket</a>
                    </li>

                    <li class="nav-item ml-4">
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
                            <a href="/keranjangPesanan" class="dropdown-item dropdown-footer" >Keranjang
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


        <div class="headermenu ">

        </div>
        <div style="padding-top: 200px"></div>

        <div id="content" class="container menupaket rounded">
            @yield('content')
        </div>

        <aside class="control-sidebar control-sidebar-light">
            <!-- Control sidebar content goes here -->
            <div class="p-5">
                <button class="btn btn-info" data-widget="control-sidebar"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
                <button class="btn btn-danger pull-right" data-widget="control-sidebar"><i class="fa fa-trash" aria-hidden="true"></i></button>
                @if (auth()->check())
                <h6 class="pt-5">No. Transaksi {{noTrans_otomatis(auth()->user()->username)}}</h6>
                <input id='noTrans' hidden value='{{noTrans_otomatis(auth()->user()->username)}}' />
                <input id='id' hidden value='{{auth()->user()->username}}' />
                @endif

                <div id="pesanan">

                </div>

            </div>
        </aside>
        @yield('footer')

    </div>

    <!-- JS -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('/js/jquery.min.js') }}"></script>\
    <script src="{{asset ('/js/sweetalert2.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset ('/adminlte/js/adminlte.js')}}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function tampilPesanan() {

            var username = $("#username").val();

            $.ajax({
                type: 'GET',
                url: '/tampilpesanan',
                data: {
                    username: username,
                },
                success: function(data) {
                    $("#pesanan").html(data.html);
                }
            });
        }

        $(window).on("load", function() {
            tampilPesanan();
        });

        function deletePesanan(idPesanan) {

            $.ajax({
                type: 'POST',
                url: '/deletePesanan',
                data: {
                    idPesanan: idPesanan,
                },
                success: function(data) {
                    location.reload();
                }
            });
        }
    </script>

    @yield('script')

</body>

</html>
