<?php

namespace App\Http\Controllers\Api\Order;

use App\Actions\Order\Create as CreateOrderAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\CreateRequest;
use App\Http\Resources\OrderResource;

class CreateController extends Controller
{
    private CreateOrderAction $orderCreateAction;
    public function __construct(CreateOrderAction $orderCreateAction)
    {
        $this->orderCreateAction = $orderCreateAction;
    }
    public function __invoke(CreateRequest $request)
    {
        $order = ($this->orderCreateAction)($request->validated());
        return new OrderResource($order);
    }
}
