@extends('layout')

@section('content')
<section id="edit-stall">
	<!-- FORM -->
	<stall-form method="POST" :stalls="{{ $stalls }}" action="{{ route('stalls.store') }}" server="{{ $server->name }}">
		{{ csrf_field() }}
	</stall-form>
</section>
@endsection