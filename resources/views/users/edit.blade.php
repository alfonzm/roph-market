@extends('layout')

@section('content')
	<section id="edit-user">
		<h2>
			Edit Profile
		</h2>
        <form method="POST" action="{{ route('users.update', ['id' => Auth::user()->id]) }}" autocomplete="on">
            {{ csrf_field() }}
    	    <table>
                <tbody>
                	<!-- Username -->
                    <tr>
                        <td>
                            <label for="name">Username</label>
                        </td>
                        <td>
                            <input id="name" type="text" name="name" value="{{ $user->name }}" required /> 
                        </td>
                    </tr>
                	<!-- Playing schedule -->
                    <tr>
                        <td valign="top">
    				        <label for="schedule">Playing Schedule</label>
                        </td>
                        <td>
                            <textarea name="schedule" id="schedule" cols="40" rows="3" placeholder="e.g. I am online during weekends at around 7-10 PM">{{ $user->schedule }}</textarea>
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
        </form>

        <h2>
            IGNs
            <span class="subheader">Add your characters' names here so buyers can contact you in-game.</span>
        </h2>
		<div>
            <igns-form :igns="{{ json_encode($user->groupedIgns) }}" :user-id="{{ $user->id }}"></igns-form>
		</div>
	</section>
@endsection