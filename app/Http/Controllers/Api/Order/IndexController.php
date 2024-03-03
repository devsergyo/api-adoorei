<?php

namespace App\Http\Controllers\Api\Order;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Repositories\OrderRepository;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class IndexController extends Controller
{

    private OrderRepository $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function __invoke(): AnonymousResourceCollection
    {
        return OrderResource::collection($this->orderRepository->getAll());
    }

}
