<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gajah Mada Kursus</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Ubuntu:400,700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset ('adminlte/plugins/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset ('adminlte/css/font-awesome/css/adminlte.min.css')}}">
    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/css/genosstyle.css') }}" rel="stylesheet" />


</head>

<body>

    <nav class="navbar navbarfont navbar-expand-lg navbar-inverse navbar-dark  home" style="height: 100px;background-color: rgba(0, 0, 0, 0);padding-top: 180px">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span id="toggler"><i class="fa fa-bars" aria-hidden="true"></i></span>
        </button>
        <a class="navbar-brand" href="#">
            <!-- <img src="{{ asset('/assets/gambar/logo2.png') }} " alt="logo" /> -->
        </a>

        <div class="collapse navbar-collapse " id="navbarTogglerDemo03">
            <ul class="navbar-nav mt-2 mt-sms-0  ">
                <li class="nav-item ml-4">
                    <a id="home" class="nav-link" href="/">Home </a>
                </li>

                <li class="nav-item ml-4">
                    <a class="nav-link" href="{{route('paket')}}">Paket</a>
                </li>

                <li class="nav-item ml-4">
                    <a class="nav-link" href="#">Kontak</a>
                </li>

                <li class="nav-item ml-4 mr-5">
                    <a class="nav-link" href="/login"> Login <i class="fa fa-user"></i></a>
                </li>

            </ul>
        </div>
    </nav>

    <div class="headermenu ">

    </div>
    <div style="padding-top: 200px"></div>

    <div id="content" class="container menupaket rounded">
        @yield('content')

    </div>

    @yield('footer')

    <!-- JS -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('/js/jquery.min.js') }}"></script>

    @yield('script')

</body>

</html>
