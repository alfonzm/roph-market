@extends('layout')

@section('content')
	<section id="show-stall">
		<h2>
			<img src="{{ asset('img/vend_2x.png') }}" />{{ $stall->name }}
		</h2>

		@if (count($stall->stallItems) == 0)
			No items
		@else
			<h3>Items in stall</h3>
			<stall-item-list :stall-items="{{ $stall->stallItems }}"></stall-item-list>
		@endif
	</section>
@endsection