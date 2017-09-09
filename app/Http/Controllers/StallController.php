<?php

namespace App\Http\Controllers;

use Auth;
use App\Stall;
use App\StallItem;
use App\Server;
use Illuminate\Http\Request;

class StallController extends Controller
{
    public function index()
    {
        return Stall::latest()->get();
    }

    public function create()
    {
        return view('stalls/create');
    }

    public function store(Request $request)
    {
        $stall = Stall::create([
            'name' => request('name'),
            'user_id' => Auth::id(),
            'server_id' => Server::first()->id,
        ]);

        $stallItems = [];
        $stallItemsRequest = request('stall_items');

        foreach($stallItemsRequest as $stallItem) {
            $stallItems[] = new StallItem($stallItem);
        }

        return $stall->stallItems()->saveMany($stallItems);
    }

    public function search(Request $request)
    {
        $roItemIdToSearch = $request->input('i');
        $results = Stall::with(['stallItems' => function ($query) use ($roItemIdToSearch) {
            $query->where('ro_item_id', '=', $roItemIdToSearch);
        }])->whereHas('stallItems', function ($query) use ($roItemIdToSearch) {
            $query->where('ro_item_id', '=', $roItemIdToSearch);
        })->get();

        return $results;
    }

    public function show(Stall $stall)
    {
        // $stall = Stall::find($stallId);
        return view('stalls/show', [
            'stall' => $stall->load('stallItems.roItem')
        ]);
    }

    public function edit(Stall $stall)
    {
        //
    }

    public function update(Request $request, Stall $stall)
    {
        //
    }

    public function destroy(Stall $stall)
    {
        $stall->delete();
        return 204;
    }
}
