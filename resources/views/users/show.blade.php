@extends('layout')

@section('content')
	<section id="show-user">
		<div id="title">
			<h2 id="username">
				{{ $user->name }}
			</h2>
			<a
				href="{{ route('users.edit') }}"
				id="edit-profile-link"
				class="button basic">
				Edit Profile
			</a>
		</div>

		<h3>Stalls</h3>

		@if (count($user->stalls) == 0)
			No stalls found.
		@else
			<stall-list :stalls="{{ $user->stalls }}"></stall-list>
		@endif
	</section>
@endsection