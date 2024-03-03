<?php

namespace App\Actions\Order;

use App\Repositories\OrderRepository;

class Index
{

    private OrderRepository $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function __invoke(): array
    {
        return $this->orderRepository->getAll();
    }
}
