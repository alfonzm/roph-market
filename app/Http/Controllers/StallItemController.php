<?php

namespace App\Http\Controllers;

use Auth;
use App\StallItem;
use App\Http\Traits\StallItemSearchTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class StallItemController extends Controller
{
	use StallItemSearchTrait;

	// api/v1/stall-items/search?s=1172
	// api/v1/stall-items/search?q=red+potion
	public function search(Request $request)
	{
		return $this->searchStallItem($request);
	}

	public function index(Request $request)
	{
		$queryBuilder = StallItem::with(['stall.user' => function($query) {
			$query->select('id', 'name');
		}, 'stall', 'cards.roItem', 'roItem']);

		if($request->input('server_id')) {
			$serverId = $request->input('server_id');
		} else if(isset($_COOKIE['server'])) {
			$serverId = $_COOKIE['server'];
		}

		if($serverId) {
			$queryBuilder->whereHas('stall', function($query) use ($serverId) {
				$query->where('server_id', $serverId);
			});
		}

		return $queryBuilder->latest()->limit(10)->get();
	}

	public function destroy($stallItemId) {
		$stallItem = StallItem::with('stall.stallItems')->find($stallItemId);

		if(!Gate::allows('update-stall', $stallItem->stall)) {
            abort(404);
        }

		if(count($stallItem->stall->stallItems) <= 1) {
	        return response(['success' => 'false', 'message' => 'Your stall must have at least one item.'], 400);
		}

        if(StallItem::destroy($stallItemId)) {
            return response(['success' => 'true']);
        }

        return response(['success' => 'false', 'message' => 'Failed to remove item.'], 400);
	}
}
