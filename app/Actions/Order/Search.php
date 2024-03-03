<?php

namespace App\Actions\Order;

use App\Http\Requests\Order\SearchRequest;
use App\Repositories\OrderRepository;

class Search
{

    private OrderRepository $orderRepository;


    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function __invoke(array $data): array
    {
        return $this->orderRepository->getById($data['id']);
    }
}