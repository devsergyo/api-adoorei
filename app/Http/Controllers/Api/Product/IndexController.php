<?php

namespace App\Http\Controllers\Api\Product;

use App\Actions\Product\Index as ProductIndexAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    private ProductIndexAction $productIndexAction;
    public function __construct(ProductIndexAction $productIndexAction)
    {
        $this->productIndexAction = $productIndexAction;
    }

    public function __invoke(Request $request)
    {
        return ProductResource::collection(($this->productIndexAction)($request));
    }
}
