@extends('layout')

@section('content')
<section>
	<h2>Create stall</h2>
	
	<stall-form method="POST" action="{{ route('stalls.store') }}">
		{{ csrf_field() }}
	</stall-form>
</section>
@endsection