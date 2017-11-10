@extends('layout')

@section('content')
<section id="reset-password">
    <h2>Reset Password</h2>

    <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
        {{ csrf_field() }}

        @if (session('status'))
            <div class="message success">
                {{ session('status') }}
            </div>
        @endif

        <h4>
            Please enter your e-mail address:
        </h4>
        <input id="email" type="email" name="email" value="{{ $email or old('email') }}" size="30" required autofocus>
        @if ($errors->has('email'))
            <span class="error">
                {{ $errors->first('email') }}
            </span>
        @endif

        <p>
            <button type="submit">
                Reset Password
            </button>
        </p>
    </form>
</section>
@endsection


<!-- @extends('layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Reset Password</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Send Password Reset Link
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
 -->