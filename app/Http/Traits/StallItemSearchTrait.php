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
					$query->where('name', 'like', '%' . $searchQuery . '%')
					->orWhere(\DB::raw('concat(modifier, " ", name)'), 'like', '%' . $searchQuery . '%')
					->orWhere(\DB::raw('concat("+", refine, " ", modifier, " ", name)'), 'like', '%' . $searchQuery . '%')
					->orWhere(\DB::raw('concat("+", refine, " ", name)'), 'like', '%' . $searchQuery . '%')
					;
				})
				->orWhereHas('cards', function($query) use ($searchQuery) {
					$query->whereHas('roItem', function($query) use ($searchQuery) {
						$query->where('name', 'like', '%' . $searchQuery . '%');
					});
				});
			});

			// check for refine
			// if(preg_match("/^\+([0-9]+)/", $searchQuery, $output_array)) {
			// 	if(isset($output_array[1])) {
			// 		$queryBuilder->where('refine', '=', $output_array[1]);
			// 	}
			// }
		}

		// Get server id
		if($request->input('server_id')) {
			$serverId = $request->input('server_id');
		} else if(isset($_COOKIE['server'])) {
			$serverId = $_COOKIE['server'];
		}

		// Get stall type (buying or selling)
		$stallType = $request->input('type') ? strtolower($request->input('type')) : 'selling';

		// Set server id or type
		if($serverId || $stallType) {
			$queryBuilder->whereHas('stall', function($query) use ($serverId, $stallType) {
				if($serverId) {
					$query->where('server_id', $serverId);
				}

				if($stallType && ($stallType == 'selling' || $stallType == 'buying')) {
					$query->where('type', $stallType);
				}
			});
		}

		// Build
		$query = $queryBuilder->orderBy('updated_at', 'DESC')->orderBy('id',  'DESC');

		$limit = 15;
		
		return $query->paginate($limit);
	}
}