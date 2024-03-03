<?php

namespace App\Repositories;

use App\Interfaces\RepositoryInterface;
use App\Models\Order;

class OrderRepository implements RepositoryInterface
{

    public function getAll(): array
    {
        return Order::all()->toArray();
    }
}
