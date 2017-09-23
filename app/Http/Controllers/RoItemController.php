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
            // if location is 34 (two handed weapon), set filter to 2 (weapon location)
            $filter = $locationFilter == 34 ? 2 : $locationFilter;
	    	$q->where('equip_locations', '=', $filter);
        }

    	return $q->limit(10)->get();
    }
}
