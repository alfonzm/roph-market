<?php

namespace App\Http\Controllers;

use Auth;
use App\Stall;
use App\StallItem;
use App\RoItem;
use App\Server;
use Illuminate\Http\Request;

class RoItemController extends Controller
{
    public function search(Request $request)
    {
        $searchTerm = $request->input('s');
        $q = RoItem::where('name', 'like', '%' . $searchTerm . '%');

        $typeFilter = $request->input('type');

        if($typeFilter) {
	    	$q->where('type', '=', $typeFilter);
        }

    	return $q->limit(10)->get();
    }
}
