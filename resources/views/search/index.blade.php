@extends('layout')

@section('content')
	<section id="search">
		<!-- {{ $results }} -->
		<!-- {{ $query }} -->
		<stall-item-search
			:initial-stall-items="{{ $results }}"
			initial-query="{{ $query }}"
			@if(!empty($roItem))
			:initial-ro-item-to-search="{{ $roItem }}"
			@endif
			autofocus="autofocus"
			/>
	</section>
@endsection