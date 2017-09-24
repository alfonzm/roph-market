@extends('layout')

@section('content')
	<section id="show-stall">
		<div id="stall-items">
			<div class="stall-name">
				<!-- Stall img and title -->
				<div class="stall-name-img">
					<img src="{{ asset('img/vend_2x.png') }}" />
				</div>

				<!-- Edit stall button -->
				@if(Auth::check() && $stall->user_id == Auth::user()->id)
				<a
					class="button basic edit-stall-link"
					href="{{ route('stalls.edit', ['stall' => $stall->id]) }}"
					>Edit Stall
				</a>
				@endif

				<div class="stall-name-name">
					<h2>
						{{ $stall->name }}
						<span class="subheader">Last updated <time-ago-date date="{{ $stall->updated_at }}" /></span>
					</h2>
				</div>
			</div>

			@if (count($stall->stallItems) == 0)
				No items found.
			@else
				<stall-item-list :stall-items="{{ $stall->stallItems }}"></stall-item-list>
			@endif

			@if(!empty($stall->description))
			<div id="stall-description">
				<h3>Notes</h3>
				<p>{{ $stall->description }}</p>
			</div>
			@endif
		</div>
		<aside>
			<h3>Vendor</h3>
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