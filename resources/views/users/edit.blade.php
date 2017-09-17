@extends('layout')

@section('content')
	<section id="edit-user">
		<h2>
			Edit Profile
		</h2>
	    {!! Form::open(['url' => route('users.update', $user->id)]) !!}
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
				        {{ Form::label('schedule', 'Playing Schedule') }}
                    </td>
                    <td>
				        {{ Form::textarea('name', $user->schedule, ['rows' => 3, 'placeholder' => 'e.g. I am online during weekends at around 7-10 PM']) }}
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        {{ Form::submit('Save') }}
                    </td>
                </tr>
            </tbody>
        </table>
        {!! Form::close() !!}

        <h2>IGNs</h2>
		<div>
            <igns-form :igns="{{ json_encode($user->groupedIgns) }}" :user-id="{{ $user->id }}"></igns-form>
		</div>
	</section>
@endsection