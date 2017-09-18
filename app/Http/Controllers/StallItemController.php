<?php

namespace App\Http\Controllers;

use Auth;
use App\StallItem;
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

	public function destroy($stallItemId) {
		$stallItem = StallItem::with('stall.stallItems')->find($stallItemId);

		if(count($stallItem->stall->stallItems) <= 1) {
	        return response(['success' => 'false', 'message' => 'Your stall must have at least one item.'], 400);
		}

        if(StallItem::destroy($stallItemId)) {
            return response(['success' => 'true']);
        }

        return response(['success' => 'false', 'message' => 'Failed to remove item.'], 400);
	}
}
