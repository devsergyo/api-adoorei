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

    public function getById(int $id): array
    {
        return (Order::find($id))->toArray();
    }
}
