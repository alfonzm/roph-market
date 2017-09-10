@extends('layout')

@section('content')
<section>
	<h2>Create stall</h2>
	
	<create-stall method="POST" action="{{ route('stalls.store') }}">
		{{ csrf_field() }}
	</create-stall>
</section>
@endsection