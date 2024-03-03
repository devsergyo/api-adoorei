<?php

namespace App\Actions\Product;

use App\Repositories\ProductRepository;
use Illuminate\Database\Eloquent\Collection;

class Index
{

    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function __invoke(): array
    {
        return $this->productRepository->getAll();
    }
}
