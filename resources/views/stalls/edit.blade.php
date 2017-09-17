@extends('layout')

@section('content')
<section>
	<h2>Edit stall</h2>
	<stall-form method="POST" action="{{ route('stalls.update', $stall->id) }}" :initial-stall="{{ $stall }}">
		{{ method_field('PUT') }}
		{{ csrf_field() }}
	</stall-form>
</section>
@endsection