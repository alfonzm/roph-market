@extends('layout')

@section('content')
<div>
    <form method="POST" action="{{ route('login') }}" autocomplete="on">
        {{ csrf_field() }}

        <table>
            <tbody>
                <!-- Email -->
                <tr>
                    <td>
                        <label for="email">E-Mail Address</label>
                    </td>
                    <td>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus size="30">
                        @if ($errors->has('email'))
                        <span>
                            <strong>{{ $errors->first('email') }}</strong>
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
                        <span>
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </td>
                </tr>

                <!-- Remember me -->
                <!-- <tr>
                    <td>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                            </label>
                        </div>
                    </td>
                </tr> -->
            </tbody>
        </table>

        <!-- Forgot password -->
        <p>
            <a href="{{ route('password.request') }}">
                Forgot Your Password?
            </a>
        </p>

        <!-- Submit -->
        <button type="submit">
            Login
        </button>

    </form>
</div>
@endsection
