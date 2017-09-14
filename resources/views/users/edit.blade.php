@extends('layout')

@section('content')
	<section id="edit-user">
		<h2>
			Edit Profile
		</h2>

	    {!! Form::open(['url' => route('users.update', $user->id)]) !!}
    		<h3>Profile</h3>
		    <table>
	            <tbody>
	            	<!-- Username -->
	                <tr>
	                    <td>
					        {{ Form::label('name', 'Username') }}
	                    </td>
	                    <td>
					        {{ Form::text('name', $user->name, ['required']) }}
	                    </td>
	                </tr>
	            	<!-- Playing schedule -->
	                <tr>
	                    <td valign="top">
					        {{ Form::label('schedule', 'Schedule') }}
	                    </td>
	                    <td>
					        {{ Form::textarea('name', $user->schedule, ['rows' => 3, 'placeholder' => 'e.g. I am online during weekends at around 7-10 PM']) }}
	                    </td>
	                </tr>
	            </tbody>
	        </table>

	        <h3>IGNs</h3>

			<div>
		        @if(count($user->igns) <= 0)
			        You have no IGNs.
		        @else
		        	<igns-form :igns="{{ $user->igns }}" :user-id="{{ $user->id }}"></igns-form>
		        @endif

			</div>

	        {{ Form::submit('Save') }}
        {!! Form::close() !!}
	</section>
@endsection