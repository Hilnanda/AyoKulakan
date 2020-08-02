@extends('layouts.auth')

@section('content')
<style type="text/css">
    .card {
        height: 500px;
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
                <div class="text-center">
                    <h5>
                        <small>
                            <label style="color:white" style="font-family:verdana">Belum Punya Akun Ayokulakan?</label>
                            <a href="{{ url('/register') }}" style="color: #fd842b">Daftar</a>
                        </small>
                    </h5>
                </div>
            </div>
            <div class="card-body">

                <form role="form" action="{{ url('/login') }}" method="post" class="login-form clearfix">
                    {!! csrf_field() !!}

                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" name="email" placeholder="Email..."
                            class="form-username form-control no-border ft0" id="form-username" value="" pattern=".{2,40}"
                            required title="2 to 40 characters" maxlength="40">

                    </div>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="password" name="password" placeholder="Kata Sandi..."
                            class="form-password form-control no-border ft0" id="form-password" pattern=".{2,30}" required
                            title="2 to 30 characters" maxlength="30">
                    </div>
                    <div class="row login-tools">
                        <div class="col-lg-6">
                            <label class="i-checks">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="form-remember">
                                    <label class="custom-control-label" for="form-remember" style="color: white">Ingat
                                        saya</label>
                                </div>
                            </label>
                        </div>
                        <div class="col-lg-6">
                            <a href="{{ url('password/reset') }}" style="color: white">Lupa password?</a>
                        </div>
                    </div>
                    <button type="submit"
                        class="btn btn-lg button login ayokulakan btn-block mt-2 mt-md-4">LOGIN</button>
                    <div class="text-center m-t m-b"><a href="{{url('password/reset')}}" class="forget margin"></a>
                    </div>
                </form>
                <p class="mt-2">
                    <a href="{{ url('login/phone') }}" style="color: white">Login menggunakan nomor telepon</a>
                </p>
                
                <div>
                    <span>
                        <a href="{{ url('/login/facebook') }}">
                            <i class="fab fa-facebook-f fa-sm" style="color: #fff; background-color: #1d4b98; padding: 10px 0; border-radius: 5px; width: 50px; height: 50px; font-size: 26px;"></i>
                        </a>
                    </span>
                    <span>
                        <a href="{{ url('/login/google') }}">
                            <i class="fab fa-google fa-sm" style="color: #fff; background-color:#dd4c39; padding: 10px 0; border-radius: 5px; width: 50px; height: 50px; font-size: 26px;"></i>
                        </a>
                </span>
                </div>

                 
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
@endsection
