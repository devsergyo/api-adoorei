<?php

namespace App\Http\Controllers\Api\Order;

use App\Actions\Order\Search as SearchOrderAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\SearchRequest;
use App\Http\Resources\OrderResource;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SearchController extends Controller
{

    private SearchOrderAction $orderSearchAction;
    public function __construct(SearchOrderAction $orderSearchAction)
    {
        $this->orderSearchAction = $orderSearchAction;
    }
    public function __invoke(SearchRequest $request)
    {
        $order = ($this->orderSearchAction)($request->validated());
        return OrderResource::collection($order);
    }

}
