<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Stall;
use App\StallItem;
use App\StallItemCard;
use App\RoItem;
use App\Server;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
    	$roItemId = $request->input('s');
    	$roItem = RoItem::where('id', $roItemId)->first();
    	$query = $roItem->name;

        $results = StallItem::with('stall', 'roItem', 'cards')
        				->where('ro_item_id', $roItemId)
        				->orderBy('created_at', 'DESC')
        				->get();

        return view('search/index', compact('results', 'roItem', 'query'));
    }
}
