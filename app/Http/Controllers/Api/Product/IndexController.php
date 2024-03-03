<?php

namespace App\Http\Controllers\Api\Product;

use App\Actions\Product\Index as ProductIndexAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 *
 */
class IndexController extends Controller
{
    /**
     * @var ProductIndexAction
     */
    private ProductIndexAction $productIndexAction;

    /**
     * @param ProductIndexAction $productIndexAction
     */
    public function __construct(ProductIndexAction $productIndexAction)
    {
        $this->productIndexAction = $productIndexAction;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function __invoke(): AnonymousResourceCollection
    {
        return ProductResource::collection(($this->productIndexAction)());
    }
}
