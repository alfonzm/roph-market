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
                            @if ($errors->has('name'))
                            <span class="error">
                                {{ $errors->first('name') }}
                            </span>
                            @endif
                        </td>
                    </tr>
                    <!-- Contact Information -->
                    <tr>
                        <td valign="top">
                            <label for="contact">Contact Info</label>
                        </td>
                        <td>
                            <textarea name="contact" id="contact" cols="50" rows="4" placeholder="(optional) e.g. your Facebook profile URL or your vending spot location">{{ $user->contact }}</textarea>
                        </td>
                    </tr>
                	<!-- Playing schedule -->
                    <tr>
                        <td valign="top">
    				        <label for="schedule">Playing Schedule</label>
                        </td>
                        <td>
                            <textarea name="schedule" id="schedule" cols="50" rows="4" placeholder='(optional) e.g. "I am online during weekends at around 7-10 PM"'>{{ $user->schedule }}</textarea>
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
            <span class="subheader">Add your RO characters' in-game names here so other players can contact you in-game.</span>
        </h2>
		<div>
            <igns-form :igns="{{ json_encode($user->groupedIgns) }}" :user-id="{{ $user->id }}"></igns-form>
		</div>
	</section>
@endsection