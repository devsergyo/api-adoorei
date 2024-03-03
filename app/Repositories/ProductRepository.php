<?php

namespace App\Repositories;

use App\Interfaces\RepositoryInterface;
use App\Models\Product;

class ProductRepository implements RepositoryInterface
{

    public function getAll(): array
    {
        return Product::all()->toArray();
    }
}
