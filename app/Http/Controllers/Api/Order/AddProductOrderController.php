<?php

namespace App\Http\Controllers\Api\Order;

use App\Actions\Order\AddProductOrder as AddProductOrderAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\AddProductOrderRequest;
use App\Http\Resources\OrderResource;

class AddProductOrderController extends Controller
{
    private AddProductOrderAction $addProductOrderAction;
    public function __construct(AddProductOrderAction $addProductOrderAction)
    {
        $this->addProductOrderAction = $addProductOrderAction;
    }
    public function __invoke(AddProductOrderRequest $request): OrderResource
    {
        $order = ($this->addProductOrderAction)($request->validated());
        return new OrderResource($order);
    }
}
