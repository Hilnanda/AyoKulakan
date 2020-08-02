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
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                <span>{{ $error }}</span>
                @endforeach
            </div>
            @endif
            <div class="card">
                <div class="card-header"><h3>Reset Passwords</h3></div>
                <div class="card-body">
                    <form class="login-form clearfix" method="POST" action="{{ url('password/change') }}">
                        @csrf
                        <div class="form-group input-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input id="email" type="email" class="form-control form-username no-border ft0" name="email" placeholder="email..." value="{{ $email or old('email') }}" title="2 to 40 characters" maxlength="40" autofocus>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="form-group input-group {{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input id="password" type="password" class="form-control form-password no-border ft0" name="password" placeholder="password...">
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group input-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="confirm pass...">
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <button type="submit" class="btn btn-lg button login ayokulakan btn-block mt-2 mt-md-4">Reset Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
