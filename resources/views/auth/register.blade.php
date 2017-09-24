@extends('layout')

@section('content')
<section id="signup">
    <h3>Create Account</h3>

    <form method="POST" action="{{ route('register') }}" autocomplete="on">
        {{ csrf_field() }}

        <table class="signup">
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

                <!-- Username -->
                <tr>
                    <td>
                        <label for="name">Username</label>
                    </td>
                    <td>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required size="30">
                        @if ($errors->has('name'))
                        <span class="error">
                            {{ $errors->first('name') }}
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

                <!-- IGN -->
                <tr>
                    <td>
                        <label for="ign">IGN</label>
                    </td>
                    <td>
                        <input id="ign" type="text" name="ign" value="{{ old('ign') }}" required size="30" placeholder="You can add/edit IGNs later">
                        @if ($errors->has('name'))
                        <span class="error">
                            {{ $errors->first('ign') }}
                        </span>
                        @endif
                    </td>
                </tr>

                <!-- Server IGN -->
                <tr class="server">
                    <td>
                    </td>
                    <td>
                        <select name="server_id">
                            <option value="1" selected>Loki</option>
                            <option value="2">Thor</option>
                            <option value="3">Chaos</option>
                        </select>
                    </td>
                </tr>

                <!-- Submit button -->
                <tr class="padded-top">
                    <td></td>
                    <td>
                        <!-- Submit -->
                        <button type="submit">
                            Create account
                        </button>
                    </td>
                </tr>

                <tr class="padded-top">
                    <td></td>
                    <td>
                        <a href="{{ route('login') }}">
                            Already have an account? Login here.
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</section>
@endsection