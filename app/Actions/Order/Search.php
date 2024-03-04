<?php

namespace App\Actions\Order;

use App\Repositories\OrderRepository;

class Search
{

    private OrderRepository $orderRepository;


    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function __invoke(array $data)
    {
        return $this->orderRepository->getById($data['id']);
    }
}
