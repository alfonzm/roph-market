@extends('layout')

@section('content')
<section id="reset-password">
    <h2>Reset Password</h2>

    <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
        {{ csrf_field() }}

        <input type="hidden" name="token" value="{{ $token }}">

        <h4>
            E-mail adress
        </h4>
        <input id="email" type="email" name="email" value="{{ $email or old('email') }}" required autofocus>
        @if ($errors->has('email'))
            <span class="error">
                {{ $errors->first('email') }}
            </span>
        @endif

        <h4>
            New Password
        </h4>
        <input id="password" type="password" name="password" required>
        @if ($errors->has('password'))
            <span class="error">
                {{ $errors->first('password') }}
            </span>
        @endif

        <h4>
            Confirm New Password
        </h4>
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
        @if ($errors->has('password_confirmation'))
            <span class="error">
                {{ $errors->first('password_confirmation') }}
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
