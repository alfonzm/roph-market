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
				@if(count($stall->user->groupedIgns) > 0)
					@foreach($stall->user->groupedIgns as $server => $igns)
						<h5>{{ $server }}</h5>
						@foreach($igns as $ign)
							<li>{{ $ign['ign'] }}</li>
						@endforeach
					@endforeach
				@else
					<p>
						<span class="muted">No IGNs.</span>
					</p>
				@endif
			</ul>

			<!-- <h4>Contact</h4> -->

			<h4>Playing Schedule</h4>
			<p>
				@if(!empty($stall->user->schedule))
					{{ $stall->user->schedule }}
				@else
					<span class="muted">No playing schedule specified.</span>
				@endif
			</p>
		</aside>
	</section>
@endsection