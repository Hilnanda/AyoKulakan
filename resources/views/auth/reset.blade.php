@extends('layouts.auth')

@section('content')

<div class="form-bottom">
    <div class="">
        <div class="wrapper text-center">
            <h4>Reset Password</h4>
        </div>
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
            <span>{{ $error }}</span>
            @endforeach
        </div>
        @endif


        <form role="form" action="{{ url('/password/email') }}" method="post" class="login-form clearfix">
            {!! csrf_field() !!}
            <div class="form-group">
                <input id="email" type="email" class="form-username form-control no-border" name="email" placeholder="Email" required><br>
                <input id="password" type="password" class="form-username form-control no-border" name="password" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-lg button login gmf btn-success">Kirim Link Reset Password</button>
            <div class="text-center m-t m-b"><a href="{{ url('login') }}" class="forget margin">Kembali ke halaman login ?</a></div>
        </form>
    </div>
</div>

@endsection
