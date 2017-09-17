<?php

namespace App\Http\Controllers;

use Auth;
use App\Stall;
use App\StallItem;
use App\Server;
use App\Http\Traits\StallItemSearchTrait;
use Illuminate\Http\Request;

class StallItemController extends Controller
{
	use StallItemSearchTrait;

	// api/v1/stall-items/search?s=1172
	// api/v1/stall-items/search?q=red+potion
	public function search(Request $request)
	{
		return $this->searchStallItem($request);
	}
}
