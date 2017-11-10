@extends('layout')

@section('content')
<section id="login">
    <h2>Login</h2>
    <form method="POST" action="{{ route('login') }}" autocomplete="on">
        {{ csrf_field() }}

        <table class="login">
            <tbody>
                <!-- Email -->
                <tr>
                    <td>
                        <label for="email">E-Mail Address</label>
                    </td>
                    <td>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus size="30">
                        @if ($errors->has('email'))
                        <span class="error">
                            {{ $errors->first('email') }}
                        </span>
                        @endif
                    </td>
                </tr>

                <!-- Password -->
                <tr>
                    <td>
                        <label for="password">Password</label>
                    </td>
                    <td>
                        <input id="password" type="password" class="form-control" name="password" required size="30">

                        @if ($errors->has('password'))
                        <span class="error">
                            {{ $errors->first('password') }}
                        </span>
                        @endif
                    </td>
                </tr>

                <!-- Submit -->
                <tr class="padded-top">
                    <td></td>
                    <td>
                        <button type="submit">
                            Login
                        </button>
                    </td>
                </tr>

                <!-- Forgot password -->
                <!-- <tr class="padded-top">
                    <td></td>
                    <td>
                        <a href="{{ route('password.request') }}" class="forgot-pass">
                            Forgot your password?
                        </a>
                    </td>
                </tr> -->

                <!-- Register -->
                <tr class="padded-top">
                    <td></td>
                    <td>
                        <a href="{{ route('register') }}">
                            Don't have an account? Sign up here.
                        </a>
                    </td>
                </tr>

                <!-- Forgot -->
                <tr class="padded-top">
                    <td></td>
                    <td>
                        <a href="{{ route('password.request') }}">
                            Forgot your password?
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>

    </form>
</section>
@endsection