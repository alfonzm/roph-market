<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\UserIgn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function show($name)
    {
        $user = User::with('stalls', 'stalls.server', 'stalls.stallItems.cards.roItem', 'stalls.stallItems.roItem', 'igns.server')->where('name', $name)->first();

        $user->groupIgns();

        return view('users/show', compact('user'));
    }

    public function edit()
    {
    	$user = Auth::user();
    	$user->load('igns.server');
        $user->groupIgns();
        return view('users/edit', compact('user'));
    }

    public function update(Request $request, $userId)
    {
        $user = User::find($userId);

        if(!Gate::allows('update-user', $user)) {
            abort(404);
        }

        $user->name = $request->input('name');
        $user->contact = $request->input('contact');
        $user->schedule = $request->input('schedule');
        $user->save();
        
    	return redirect()->route('users.show', ['name' => $user->name]);
    }

    public function storeIgn(Request $request) {
    	$userIgn = UserIgn::create([
    		'ign' => $request->input('ign'),
    		'user_id' => Auth::user()->id,
    		'server_id' => $request->input('server_id')
		]);

		return $userIgn->load('server');
    }

    public function deleteIgn($userId, $ignId) {
        $user = User::find($userId);

        if(!Gate::allows('update-user', $user)) {
            abort(404);
        }

        if(count($user->igns) == 1) {
    		return response()->json(['success' => 'false', 'message' => 'You must have at least one IGN.'], 400);
        }

        if(UserIgn::destroy($ignId)) {
            return response()->json(['success' => 'true']);
        }

        return response()->json(['success' => 'false'], 400);
    }
}
