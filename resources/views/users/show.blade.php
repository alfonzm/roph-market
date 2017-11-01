@extends('layout')

@section('content')
	<section id="show-user">
		<div id="title">
			<h2 id="username">
				{{ $user->name }}
			</h2>
			@if($user->id == Auth::id())
			<a
				href="{{ route('users.edit') }}"
				id="edit-profile-link"
				class="button basic">
				Edit Profile
			</a>
			@endif
		</div>

		<section id="igns">
			<h3>IGNs</h3>
			<table>
				@if(count($user->groupedIgns) > 0)
					@foreach($user->groupedIgns as $server => $igns)
						<tr>
							<td class="server">{{ $server }}:</td>
							<td class="igns">
								{{
									implode(", ", array_map(function($ign) { return $ign['ign']; }, $igns))
								}}
							</td>
						</tr>
					@endforeach
				@else
					No IGNs.
				@endif
			</table>
		</section>

		<section id="contact">
			<h3>Contact Info</h3>
			@if(!empty($user->contact))
				<p>{!! nl2br(e($user->contact)) !!}</p>
			@else
				<span class="muted thin">No contact information specified.</span>
			@endif
		</section>

		<section id="schedule">
			<h3>Playing Schedule</h3>
			@if(!empty($user->schedule))
				<p>{!! nl2br(e($user->schedule)) !!}</p>
			@else
				<span class="muted thin">No playing schedule specified.</span>
			@endif
		</section>

		<section id="stalls">
			<h3>Stalls</h3>

			@if (count($user->stalls) == 0)
				<span class="muted thin">No stalls found.</span>
			@else
				<stall-list :stalls="{{ $user->stalls }}"></stall-list>
			@endif
		</section>
	</section>
@endsection