@extends('layout')

@section('content')
<section id="signup">
    <h2>
        Create Account
    </h2>

    <form method="POST" action="{{ route('register') }}" autocomplete="on">
        {{ csrf_field() }}

        <register-form
            old-name="{{ old('name') }}"
            old-email="{{ old('email') }}"
            old-ign="{{ old('ign') }}"
            error-email="{{ $errors->first('email') }}"
            error-name="{{ $errors->first('name') }}"
            error-ign="{{ $errors->first('ign') }}"
            error-password="{{ $errors->first('password') }}"
            ></register-form>
    </form>
    <p>
        <a href="{{ route('login') }}">
            Already have an account? Login here.
        </a>
    </p>
</section>
@endsection