@extends('layout')

@section('content')
	<section id="search">
		<stall-item-search
			:initial-stall-items="{{ $results }}"
			initial-query="{{ $query }}"
			:initial-ro-item-to-search="{{ $roItem }}"
			autofocus="autofocus"
			/>
	</section>
@endsection