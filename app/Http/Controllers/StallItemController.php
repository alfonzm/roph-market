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
        $searchTerm = $request->input('s');
        
    }
}
