<?php

namespace App\Actions\Order;

use App\Http\Requests\Order\SearchRequest;
use App\Repositories\OrderRepository;

class AddProductOrder
{

    private OrderRepository $orderRepository;


    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function __invoke(array $data)
    {
        return $this->orderRepository->addProductsToOrder($data['order_id'],$data['products']);
    }
}
