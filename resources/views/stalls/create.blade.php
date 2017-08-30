@extends('layout')

@section('content')
    <h1>Create stall</h1>
    <form method="POST" action="{{ route('stalls.store') }}">
        {{ csrf_field() }}

        <create-stall></create-stall>
    </form>
@endsection