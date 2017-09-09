@extends('layout')

@section('content')

	<h1>{{ $stall->name }}</h1>

	@if (count($stall->stallItems) == 0)
		No items
	@else
		<ul>
			@foreach($stall->stallItems as $stallItem)
				<li>
			    <img src="http://imgs.ratemyserver.net/items/small/{{ $stallItem->roItem->id }}.gif"> {{ $stallItem->roItem->name }} / {{ $stallItem->price }}z / {{ $stallItem->quantity }} ea
				</li>
		    @endforeach
		</ul>
	@endif
@endsection