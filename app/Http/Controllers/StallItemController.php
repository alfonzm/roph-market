<?php

namespace App\Http\Controllers;

use Auth;
use App\Stall;
use App\StallItem;
use App\Server;
use Illuminate\Http\Request;

class StallItemController extends Controller
{
    public function search(Request $request)
    {
        $itemId = $request->input('s');
        $results = StallItem::with('stall', 'roItem', 'cards')
        				->where('ro_item_id', $itemId)
        				->orderBy('created_at', 'DESC')
        				->get();

        return $results;
    }
}
