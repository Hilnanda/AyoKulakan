@extends('layouts.auth')

@section('content')
<style type="text/css">
    .card {
        height: 400px;
        margin-top: auto;
        margin-bottom: auto;
        width: 320px;
        background-color: rgba(0, 0, 0, 0.5) !important;
    }
</style>
<div class="form-bottom">

    <div class="d-flex justify-content-center h-100">
        <div class="card">
            <div class="card-header">
                <h3>Masuk</h3>
                <center>
                    <h5><small><label style="color:white">Belum Punya Akun Ayokulakan?</label> <a
                                href="{{ url('/register') }}" style="color: #fd842b">Daftar</a></small></h5>
                </center>
                <div class="d-flex justify-content-end social_icon" style="padding-top: 8px;">
                    <span><a href="{{ url('/login/facebook') }}"><i class="fab fa-facebook-square fa-sm"
                                style="color: #1d4b98;"></i></a></span>
                    <span><a href="{{ url('/login/google') }}"><i class="fab fa-google-plus-square fa-sm"
                                style="color: #dd4c39"></i></a></span>
                </div>

            </div>
            <div class="card-body">

                {{-- <form role="form" action="{{ url('/login/phone') }}" method="post" class="login-form clearfix">
                    {!! csrf_field() !!} --}}

                    <div id="signIn">
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            </div>
                            <input type="tel" name="phone" placeholder="Phone Number..."
                                class="form-username form-control no-border" id="phoneNumber" value="" pattern=".{2,40}"
                                required title="2 to 40 characters" maxlength="40">

                        </div>
                        <button id="sign-in-button" onclick="submitPhoneNumberAuth()" class="btn btn-lg button login ayokulakan btn-block mt-2 mt-md-4">
                            LOGIN
                        </button>
                    </div>

                    <div id="otp">
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            </div>
                            <input type="text" name="phone" placeholder="Masukkan Kode OTP..."
                                    class="form-username form-control no-border" id="code" value="" pattern=".{2,40}"
                                    required title="2 to 40 characters" maxlength="40">
                        </div>

                        <button id="confirm-code" onclick="submitPhoneNumberAuthCode()" class="btn btn-lg button login ayokulakan btn-block mt-2 mt-md-4">
                            ENTER CODE
                        </button>
                    </div>

                    <div class="text-center m-t m-b">
                        <a href="{{url('password/reset')}}" class="forget margin"></a>
                    </div>
                {{-- </form> --}}
                <p class="mt-2">
                    <a href="{{ url('login') }}" style="color: white">Login menggunakan email</a>
                </p>
            </div>

        </div>
    </div>
    <br>
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
        <span>{{ $error }}</span>
        @endforeach
    </div>
    @endif
</div>

<div id="recaptcha-container"></div>
@endsection