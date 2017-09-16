@extends('layout')

@section('content')
	<section id="show-stall">
		<div id="stall-items">
			<h2>
				<img src="{{ asset('img/vend_2x.png') }}" />{{ $stall->name }}
			</h2>

			<h3>Items in stall</h3>
			@if (count($stall->stallItems) == 0)
				No items found.
			@else
				<stall-item-list :stall-items="{{ $stall->stallItems }}"></stall-item-list>
			@endif

			@if(!empty($stall->description))
				<h3>Notes</h3>
				<p>{{ $stall->description }}</p>
			@endif
		</div>
		<aside>
			<h4>Vendor</h4>
			<a href="/user/{{ $stall->user->name }}">{{ $stall->user->name }}</a>

			<h4>IGNs</h4>
			<ul>
				@foreach($stall->user->groupedIgns as $server => $igns)
					<h5>{{ strtoupper($server) }}</h5>
					@foreach($igns as $ign)
						<li>{{ $ign }}</li>
					@endforeach
				@endforeach
			</ul>

			<!-- <h4>Contact</h4> -->

			<h4>Playing Schedule</h4>
			<p>{{ $stall->user->schedule }}</p>
		</aside>
	</section>
@endsection