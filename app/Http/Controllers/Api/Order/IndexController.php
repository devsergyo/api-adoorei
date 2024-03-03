<?php

namespace App\Http\Controllers\Api\Order;

use App\Actions\Order\Index as IndexOrderAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Repositories\OrderRepository;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class IndexController extends Controller
{

    private IndexOrderAction $indexOrderAction;

    public function __construct(IndexOrderAction $indexOrderAction)
    {
        $this->indexOrderAction = $indexOrderAction;
    }

    public function __invoke(): AnonymousResourceCollection
    {
        $orders = ($this->indexOrderAction)();
        return OrderResource::collection($orders);
    }

}
