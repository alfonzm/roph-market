@extends('layout')

@section('content')
<div>
    <form method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}

        <!-- Email -->
        <div>
            <label for="email" class="col-md-4 control-label">E-Mail Address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>

            @if ($errors->has('email'))
            <span>
                <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="col-md-4 control-label">Password</label>
            <input id="password" type="password" class="form-control" name="password" required>

            @if ($errors->has('password'))
            <span>
                <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
        </div>

        <!-- Remember me -->
        <div class="checkbox">
            <label>
                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
            </label>
        </div>

        <div>
            <button type="submit">
                Login
            </button>
        </div>

        <a href="{{ route('password.request') }}">
            Forgot Your Password?
        </a>
    </form>
</div>
@endsection
