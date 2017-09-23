@extends('layout')

@section('content')
	<section id="show-user">
		<h2>
			{{ $user->name }}
			<a href="{{ route('users.edit') }}" class="edit-profile-link">Edit Profile</a>
		</h2>

		<h3>Stalls</h3>

		@if (count($user->stalls) == 0)
			No stalls found.
		@else
			<stall-list :stalls="{{ $user->stalls }}"></stall-list>
		@endif
	</section>
@endsection