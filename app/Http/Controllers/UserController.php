<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\UserIgn;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show($name)
    {
        $user = User::with(['stalls' => function($q) {
        	$q->orderBy('id', 'DESC');
	    }], 'stalls.stallItems.cards.roItem', 'stalls.stallItems.roItem', 'igns.server')->where('name', $name)->first();
        return view('users/show', compact('user'));
    }

    public function edit()
    {
    	$user = Auth::user();
    	$user->load('igns.server');
        $user->groupIgns();
        return view('users/edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        // return $request->input();
        // return User::with('igns')->find($id);
    	return redirect()->route('users.edit');
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

        if(count($user->igns) == 1) {
    		return response()->json(['success' => 'false', 'message' => 'You must have at least one IGN.']);
        }

        if(UserIgn::destroy($ignId)) {
            return response()->json(['success' => 'true']);
        }

        return response()->json(['success' => 'false']);
    }
}
