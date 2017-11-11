<?php

namespace App\Http\Traits;

use Auth;
use App\Stall;
use App\StallItem;
use App\Server;
use Illuminate\Http\Request;

trait StallItemSearchTrait
{
	// api/v1/stall-items/search?s=1172
	// api/v1/stall-items/search?q=red+potion
	public function searchStallItem(Request $request)
	{
		$itemId = $request->input('s');
		$searchQuery = $request->input('q');

		if($request->input('server_id')) {
			$serverId = $request->input('server_id');
		} else if(isset($_COOKIE['server'])) {
			$serverId = $_COOKIE['server'];
		}

		$queryBuilder = StallItem::with(['stall.user' => function($query) {
			$query->select('id', 'name');
		}, 'stall', 'cards.roItem', 'roItem']);

		if($itemId) {
			$queryBuilder->where(function ($query) use ($itemId) {
				$query->where('ro_item_id', $itemId)
				->orWhereHas('cards', function($query) use ($itemId) {
					$query->where('card_id', $itemId);
				});
			});
		} else if($searchQuery) {
			$queryBuilder->where(function($query) use ($searchQuery) {
				$query->whereHas('roItem', function($query) use ($searchQuery) {
					$query->where('name', 'like', '%' . $searchQuery . '%');
				})
				->orWhereHas('cards', function($query) use ($searchQuery) {
					$query->whereHas('roItem', function($query) use ($searchQuery) {
						$query->where('name', 'like', '%' . $searchQuery . '%');
					});
				});
			});
		}

		if($serverId) {
			$queryBuilder->whereHas('stall', function($query) use ($serverId) {
				$query->where('server_id', $serverId);
			});
		}

		return $queryBuilder->orderBy('created_at', 'DESC')->get();
	}
}
