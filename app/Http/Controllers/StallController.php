<?php

namespace App\Http\Controllers;

use Auth;
use App\Stall;
use App\StallItem;
use App\StallItemCard;
use App\Server;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class StallController extends Controller
{
    public function index()
    {
        return Stall::with('user', 'server')
                        ->where('server_id', $_COOKIE['server'])
                        ->orderBy('updated_at', 'DESC')
                        ->limit(10)
                        ->get();
    }

    public function myStall()
    {
        $stalls = Stall::with([
            // order by expiry
            'myStallItems' => function($q) { $q->orderBy('updated_at', 'desc'); },
            'myStallItems.roItem',
            'myStallItems.cards.roItem'
            ])
            ->where([
                'server_id' => $_COOKIE['server'],
                'user_id' => Auth::id()
            ])->withoutGlobalScopes()->get();

        if($stalls) {
            foreach($stalls as $stall) {
                if(!Gate::allows('update-stall', $stall)) {
                    abort(404);
                }

                // Initialize stallItems[index]->roItem->name
                // because Vue.js cannot take undefined v-model in the form
                foreach($stall->myStallItems as $stallItem) {
                    $slots = $stallItem->roItem->slots;

                    for($i = 0; $i < $slots; $i++) {
                        if(!isset($stallItem->cards[$i])) {
                            $stallItem->cards[$i] = ['ro_item' => ['name' => '']];
                        }
                    }
                }
            }
        }

        $server = Server::find($_COOKIE['server']);
        return view('stalls/edit', ['stalls' => $stalls, 'server' => $server]);
    }

    public function create()
    {
        return view('stalls/create');
    }

    public function edit(Stall $stall)
    {
        if(!Gate::allows('update-stall', $stall)) {
            abort(404);
        }

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
        $this->validate($request, [
            'server_id' => 'required',
            'type' => 'required',
        ]);

        if(Stall::where([
                'user_id' => Auth::id(),
                'server_id' => request('server_id'),
                'type' => request('type')
            ])->first()) {
            return 'You already have a stall in this server!';
        }

        $stall = Stall::create([
            'user_id' => Auth::id(),
            'server_id' => request('server_id'),
            'type' => request('type')
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
                $cards = [];
                foreach(($stallItem['cards'] ?? []) as $card) {
                    if(isset($card['card_id'])){
                        $cards[] = new StallItemCard(['card_id' => $card['card_id']]);
                    }
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
        if(!$stall) {
            abort(404);
        }

        $stall = $stall->load([
            'stallItems' => function($q) { $q->orderBy('updated_at', 'desc'); },
            'stallItems.cards.roItem',
            'stallItems.roItem'
        ]);
        $stall->user->groupIgns();
        $stall->user->igns = null;

        return view('stalls/show', compact('stall'));
    }

    public function update(Request $request, Stall $stall)
    {
        if(!Gate::allows('update-stall', $stall)) {
            abort(404);
        }

        $request = request()->input();

        $stall->server_id = $request['server_id'];
        // $stall->description = $request['description'];

        $stall->load('stallItems.roItem', 'stallItems.cards');

        if(request('stall_items')) {
            foreach(request('stall_items') as $stallItem) {
                if($stallItem['expired'] == true) {
                    continue;
                }

                $stallItemBody = [
                    'stall_id' => $stall->id,
                    'quantity' => $stallItem['quantity'],
                    'price' => $stallItem['price'],
                    'refine' => $stallItem['refine'] ?? null,
                    'ro_item_id' => $stallItem['ro_item_id'],
                    'modifier' => isset($stallItem['modifier']) ? $stallItem['modifier'] : null
                ];

                $updatedStallItem = StallItem::withoutGlobalScopes()->updateOrCreate(['id' => $stallItem['id']], $stallItemBody);

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
        $stall->touch();
        return redirect()->route('stalls.show', [$stall]);
    }

    public function destroy(Stall $stall)
    {
        if(!Gate::allows('update-stall', $stall)) {
            abort(404);
        }
                
        $stall->delete();
        
        return redirect()->route('stalls.myStall');
        // return redirect()->route('users.show', ['name' => Auth::user()->name]);
    }
}
