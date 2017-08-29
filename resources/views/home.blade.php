@extends('layout')

@section('content')
    <h1>ROPH Market</h1>

    <nav>
    @if (Auth::check())
        <a href="{{ route('logout') }}">Logout</a>
    @else
        <a href="{{ route('login') }}">Login</a>
    @endif
    </nav>


    <div>
        <item-search-bar></item-search-bar>
        <stall-list></stall-list>
    </div>
@endsection