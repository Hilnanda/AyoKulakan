@extends('layouts.auth')

@section('content')
<style type="text/css">
.card{
    height: 540px;
    margin-top: auto;
    margin-bottom: auto;
    width: 320px;
    background-color: rgba(0,0,0,0.5) !important;
}
</style>
<div class="form-bottom" style="">

    <div class="d-flex justify-content-center h-100">
        <div class="card" style="">
            <div class="card-header">
                <h3>Masuk</h3>
                <div class="ui message">
                    <center><label style="color: white">Sudah Memiliki Akun?</label> <a href="{{ url('/login') }}" style="color:#fd842b">Login</a></center>
                </div>
                <div class="d-flex justify-content-end social_icon" style="padding-top: 8px;">
                </div>

            </div>
            <div class="card-body">

                <form class="login-form clearfix" role="form" method="POST" action="{{ url('/register') }}">
                    {!! csrf_field() !!}
                    <div class="ui stacked segment">
                        <div class="form-group">
                            <div class="ui left icon input">
                                <input type="text"  class="form-control" placeholder="Name" name="name" value="{{ old('name') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="ui left icon input">
                                <input type="text"  class="form-control" placeholder="Username" name="username" value="{{ old('username') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="ui left icon input">
                                <input type="email"  class="form-control" placeholder="E-mail address" name="email" value="{{ old('email') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="ui left icon input">
                                <input type="password" class="form-control" name="password" placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="ui left icon input">
                                <input type="password" class="form-control" name="password_confirmation" placeholder="Password">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-lg button login ayokulakan btn-block mt-2 mt-md-4">Register</button>
                    </div>
                </form>
                <p class="mt-2">
                    <!--<a href="{{ url('login/phone') }}" style="color: white">Login menggunakan nomor telepon</a>-->
                </p>
                <span>
                        <a href="{{ url('/register/facebook') }}">
                            <i class="fab fa-facebook-f fa-sm" style="color: #fff; background-color: #1d4b98; padding: 10px 0; border-radius: 5px; width: 50px; height: 50px; font-size: 26px;"></i>
                        </a>
                    </span>
                    <span>
                        <a href="{{ url('/register/google') }}">
                            <i class="fab fa-google fa-sm" style="color: #fff; background-color:#dd4c39; padding: 10px 0; border-radius: 5px; width: 50px; height: 50px; font-size: 26px;"></i>
                        </a>
                    </span>

            </form>

        </div>

    </div>
</div>
<br>
@section('inierror')
@if (count($errors) > 0)
<div class="alert alert-danger">
    <div class="ui error message" style="color: black">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif
@endsection
</div>

@endsection
