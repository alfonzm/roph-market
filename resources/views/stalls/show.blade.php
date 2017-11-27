@extends('layout')

@section('content')
	<section id="show-stall">
		<div id="stall-items">
			<div class="stall-name">
				<!-- Stall img and title -->
				<div class="stall-name-img">
					<img src="{{ asset('img/'. $stall->type .'_2x.png') }}" />
				</div>

				<div class="stall-name-name">
					<h2>
						{{ $stall->user->name }}'s {{ ucfirst($stall->server->name) }} Stall <span class="label">{{ ucfirst($stall->type) }}</span>
						<span class="subheader">
							Last updated <time-ago-date date="{{ $stall->updated_at }}" />
						</span>
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
			<h3>
				@if ($stall->type == 'selling')
					Seller
				@elseif ($stall->type == 'buying')
					Buyer
				@endif
			</h3>
			<a href="/user/{{ $stall->user->name }}">{{ $stall->user->name }}</a>

			<h4>IGNs</h4>
			@if(isset($stall->user->groupedIgns[$stall->server->name]))
				<div id="igns">
					<ul class="igns">
					@foreach($stall->user->groupedIgns[$stall->server->name] as $ign)
						<li>{{ $ign['ign'] }}</li>
					@endforeach
					</ul>
				</div>
			@else
				<p>
					<span class="muted">No IGNs in this server.</span>
				</p>
			@endif

			<h4>Server</h4>
			{{ ucfirst($stall->server->name) }}

			<h4>Contact Info</h4>
			<p>
				@if(!empty($stall->user->contact))
					{!! nl2br(e($stall->user->contact)) !!}
				@else
					--
				@endif
			</p>

			<h4>Playing Schedule</h4>
			<p>
				@if(!empty($stall->user->schedule))
					{!! nl2br(e($stall->user->schedule)) !!}
				@else
					--
				@endif
			</p>
		</aside>
	</section>
@endsection