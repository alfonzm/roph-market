@extends('layout')

@section('content')
    <h1>Create stall</h1>
    <form method="POST" action="{{ route('stalls.store') }}">
        {{ csrf_field() }}

        <!-- Stall name -->
        <div>
            <label for="stall">Stall name</label>
            <input id="name" type="name" name="name" value="{{ old('name') }}" required autofocus>
        </div>

        <div>
            <button type="submit">
                Login
            </button>
        </div>
    </form>
@endsection