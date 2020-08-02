<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.longname', '#') }}</title>

        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

        <link rel="stylesheet" href="{{ asset('plugins/bootstrap/dist/css/bootstrap.min.css') }}" type="text/css" />
        <link rel="stylesheet" href="{{ asset('plugins/font-awesome/css/fontawesome-all.min.css') }}" type="text/css" />

        <link rel="stylesheet" href="{{ asset('css/login-style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/legron.css') }}">

        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png?v=zXr4R5YArk">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png?v=zXr4R5YArk">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png?v=zXr4R5YArk">
        <link rel="manifest" href="/manifest.json?v=zXr4R5YArk">
        <link rel="mask-icon" href="/safari-pinned-tab.svg?v=zXr4R5YArk" color="#5bbad5">
        <link rel="shortcut icon" href="/favicon.ico?v=zXr4R5YArk">
        <meta name="theme-color" content="#ffffff">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

    </head>

    <body>
        <!-- Top content -->

        <div class="top-content">

            {{-- <div class="inner-bg"> --}}
            <div class="container">
                <div class="row">
                    <div class="col-md-6 d-flex p-md-5 justify-content-center align-items-center">
                        <div style="">
                            @yield('inierror')
                            <a href="{{ url('/') }}">
                                <img src="{{url('img/logo/logo-long.png')}}" class="logo" alt="Logo"   />
                            </a>
                            <div class="title " style="color: #2f2f2f">
                                <h2><small>Selamat Datang Di Ayokulakan</small></h2>
                                <h5><small>Masuk Dan Penuhi Keranjang Mu Dengan Model Bisnis Mu</small></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex p-md-5 justify-content-center align-items-center form-box">
                        <div>
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>

            {{-- </div> --}}

        <script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>

        <!-- Add the latest firebase dependecies from CDN -->
        <script src="https://www.gstatic.com/firebasejs/7.14.2/firebase-app.js"></script>
        <script src="https://www.gstatic.com/firebasejs/7.14.2/firebase-auth.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                $("#otp").hide();
            })

            const firebaseConfig = {
                apiKey: "AIzaSyAhkdyHkDjCNyRaWObL_YvtF-YHaIKqGE4",
                authDomain: "ayokulakan-74fee.firebaseapp.com",
                databaseURL: "https://ayokulakan-74fee.firebaseio.com",
                projectId: "ayokulakan-74fee",
                storageBucket: "ayokulakan-74fee.appspot.com",
                messagingSenderId: "342848835492",
                appId: "1:342848835492:web:0d682d5ff79e41121efb31",
                measurementId: "G-QHVS83FELN"
            };
        </script>
        <script src="{{ asset('firebase/firebase-init.js') }}"></script>

    </body>

</html>
