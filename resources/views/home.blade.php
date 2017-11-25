@extends('layout')

@section('content')
	<section>
		<stall-item-search redirect="redirect"></stall-item-search>
	</section>
	<section>
	    <latest-stall-items></latest-stall-items>
	</section>
	<section>
	    <h2>Latest stalls</h2>
	    <latest-stalls></latest-stalls>
	</section>

@endsection