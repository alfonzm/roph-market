@extends('layout')

@section('content')
<section>
	<h2>Edit stall</h2>
	<stall-form method="POST" action="{{ route('stalls.update', $stall->id) }}" :initial-stall="{{ $stall }}">
		{{ method_field('PUT') }}
		{{ csrf_field() }}
	</stall-form>
	<br/>
	<form method="POST" action="{{ route('stalls.destroy', ['stall' => $stall->id]) }}" onsubmit="return confirm('Are you sure you want to delete this stall?')">
		{{ method_field('DELETE') }}
		{{ csrf_field() }}
        <button type="submit" class="button gray">
            Delete stall
        </button>
    </form>
</section>
@endsection