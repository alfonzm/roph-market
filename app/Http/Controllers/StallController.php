<?php

namespace App\Http\Controllers;

use Auth;
use App\Stall;
use App\StallItem;
use App\StallItemCard;
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

        foreach(request('stall_items') as $stallItem) {
            $newStallItem = $stall->stallItems()->create([
                'quantity' => $stallItem['quantity'],
                'price' => $stallItem['price'],
                'refine' => $stallItem['refine'] ?? null,
                'ro_item_id' => $stallItem['ro_item_id']
            ]);

            // Insert cards to stallItem
            $cards = [];
            foreach(($stallItem['slots'] ?? []) as $slot) {
                $cards[] = new StallItemCard(['card_id' => $slot]);
            }

            // Save all cards
            $newStallItem->cards = $newStallItem->cards()->saveMany($cards);

            // Add stall item to stallItems variable
            // $stallItems[] = $newStallItem;
        }

        return view('stalls/show', [
            'stall' => $stall->load('stallItems.cards.roItem', 'stallItems.roItem')
        ]);
        
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
        return view('stalls/show', [
            'stall' => $stall->load('stallItems.cards.roItem', 'stallItems.roItem')
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
