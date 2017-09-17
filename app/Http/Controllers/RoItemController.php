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
        $q = RoItem::where(function($query) use ($searchTerm) {
            $query->where('name', 'like', '%' . $searchTerm . '%')->orWhere('id', 'like', '%' . $searchTerm . '%');
        });

        $typeFilter = $request->input('type');
        $locationFilter = $request->input('location');

        if($typeFilter) {
            $q->where('type', '=', $typeFilter);
        }

        if($locationFilter) {
	    	$q->where('equip_locations', '=', $locationFilter);
        }

    	return $q->limit(10)->get();
    }
}
