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

		$queryBuilder = StallItem::with('stall', 'cards.roItem', 'roItem');

		if($itemId) {
			$queryBuilder
				->where('ro_item_id', $itemId)
				->orWhereHas('cards', function($query) use ($itemId) {
					$query->where('card_id', $itemId);
				});
		} else if($searchQuery) {
			$queryBuilder
				->whereHas('roItem', function($query) use ($searchQuery) {
					$query->where('name', 'like', '%' . $searchQuery . '%');
				})
				->orWhereHas('cards', function($query) use ($searchQuery) {
					$query->whereHas('roItem', function($query) use ($searchQuery) {
						$query->where('name', 'like', '%' . $searchQuery . '%');
					});
				});
		}

		return $queryBuilder->orderBy('created_at', 'DESC')->get();
	}
}
