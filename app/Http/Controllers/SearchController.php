<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Stall;
use App\StallItem;
use App\StallItemCard;
use App\RoItem;
use App\Server;
use App\Http\Traits\StallItemSearchTrait;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    use StallItemSearchTrait;

    public function index(Request $request)
    {
        $roItemId = $request->input('s');
        $searchQuery = $request->input('q');

        if(isset($_COOKIE['server'])) {
            $serverId = $_COOKIE['server'];
        }

        if ($request->input('type')) {
            $stallType = $request->input('type');
        } else if(isset($_COOKIE['stall_search_type'])) {
            $stallType = $_COOKIE['stall_search_type'];
        } else {
            $stallType = 'selling';
        }

        if($roItemId) {
        	$roItem = RoItem::where('id', $roItemId)->first();
            $query = $roItem->name;
        } else {
            $roItem = null;
        	$query = $searchQuery;
        }

        $results = $this->searchStallItem($request)->toJson();

        return view('search/index', compact('results', 'roItem', 'query', 'stallType'));
    }
}
