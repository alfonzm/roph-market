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
        return Stall::where('server_id', $_COOKIE['server'])->latest()->limit(10)->get();
    }

    public function create()
    {
        return view('stalls/create');
    }

    public function edit(Stall $stall)
    {
        $stall->load('stallItems.roItem', 'stallItems.cards.roItem');

        // Initialize stallItems[index]->roItem->name
        // because Vue.js cannot take undefined v-model in the form
        foreach($stall->stallItems as $stallItem) {
            $slots = $stallItem->roItem->slots;

            for($i = 0; $i < $slots; $i++) {
                if(!isset($stallItem->cards[$i])) {
                    $stallItem->cards[$i] = ['ro_item' => ['name' => '']];
                }
            }
        }

        return view('stalls/edit', compact('stall'));
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
            if(isset($stallItem['cards'])){
                // return $stallItem['cards'];
                $cards = [];
                foreach(($stallItem['cards'] ?? []) as $card) {
                    $cards[] = new StallItemCard(['card_id' => $card['card_id']]);
                }

                // Save all cards
                if(count($cards) > 0){
                    $newStallItem->cards = $newStallItem->cards()->saveMany($cards);
                }
            }
        }

        return redirect()->route('stalls.show', [$stall]);
    }

    public function search(Request $request)
    {
        // Search stalls by ro item id
        $roItemIdToSearch = $request->input('s');
        $results = Stall::with(['stallItems' => function ($query) use ($roItemIdToSearch) {
            $query->where('ro_item_id', '=', $roItemIdToSearch);
        }])->whereHas('stallItems', function ($query) use ($roItemIdToSearch) {
            $query->where('ro_item_id', '=', $roItemIdToSearch);
        })->get();

        return $results;
    }

    public function show(Stall $stall)
    {
        $stall = $stall->load('stallItems.cards.roItem', 'stallItems.roItem');
        $stall->user->groupIgns();
        $stall->user->igns = null;

        // return $stall;

        return view('stalls/show', compact('stall'));
    }

    public function update(Request $request, Stall $stall)
    {
        $request = request()->input();
        // return $request;

        $stall->name = $request['name'];
        $stall->server_id = $request['server_id'];
        $stall->description = $request['description'];

        $stall->load('stallItems.roItem', 'stallItems.cards');

        if(request('stall_items')) {
            foreach(request('stall_items') as $stallItem) {
                $stallItemBody = [
                    'stall_id' => $stall->id,
                    'quantity' => $stallItem['quantity'],
                    'price' => $stallItem['price'],
                    'refine' => $stallItem['refine'] ?? null,
                    'ro_item_id' => $stallItem['ro_item_id']
                ];

                $updatedStallItem = StallItem::updateOrCreate(['id' => $stallItem['id']], $stallItemBody);

                // Update/insert cards to stallItem
                $stallItemCardIdsToDelete = [];
                foreach(($stallItem['cards'] ?? []) as $stallItemCard) {
                    if(!isset($stallItemCard['card_id']) && isset($stallItemCard['id'])) {
                        $stallItemCardIdsToDelete[] = $stallItemCard['id'];
                    } else if(isset($stallItemCard['card_id'])) {
                        $updatedCard = StallItemCard::updateOrCreate(
                            ['id' => $stallItemCard['id']],
                            [
                                'card_id' => $stallItemCard['card_id'],
                                'stall_item_id' => $updatedStallItem->id
                            ]
                        );
                    }
                }

                StallItemCard::destroy($stallItemCardIdsToDelete);
            }
        }

        $stall->save();
        return redirect()->route('stalls.show', [$stall]);
    }

    public function destroy(Stall $stall)
    {
        $stall->delete();
        return 204;
    }
}
