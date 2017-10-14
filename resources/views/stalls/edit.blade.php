@extends('layout')

@section('content')
<section id="edit-stall">
	<h2>
		My stall
		@if($stall)
		<div class="subheader view-stall-link"><a href="/stalls/{{ $stall->id }}">View stall</a></div>
		@endif
	</h2>

	@if($stall)
	<stall-form method="POST" action="{{ route('stalls.update', $stall->id) }}" :initial-stall="{{ $stall }}">
		{{ method_field('PUT') }}
		{{ csrf_field() }}
	</stall-form>

	<h2>
		Delete stall
	</h2>
	This will delete all items from the stall. This action cannot be undone.
	<br>
	<br>
	<form method="POST" action="{{ route('stalls.destroy', ['stall' => $stall->id]) }}" onsubmit="return confirm('Are you sure you want to delete this stall?')">
		{{ method_field('DELETE') }}
		{{ csrf_field() }}
        <button type="submit" class="basic button danger">
            Delete stall
        </button>
    </form>
	@else
	<stall-form method="POST" action="{{ route('stalls.store') }}">
		{{ csrf_field() }}
	</stall-form>
	@endif
</section>
@endsection