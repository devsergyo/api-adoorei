<?php

namespace App\Http\Controllers\Api\Order;

use App\Actions\Order\Checkout as CheckoutOrderAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\CheckoutRequest;
use App\Http\Resources\OrderResource;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CheckoutController extends Controller
{

    private CheckoutOrderAction $orderCheckoutAction;
    public function __construct(CheckoutOrderAction $orderCheckoutAction)
    {
        $this->orderCheckoutAction = $orderCheckoutAction;
    }
    public function __invoke(CheckoutRequest $request)
    {
        $order = ($this->orderCheckoutAction)($request->validated());

        if ($order){
            return response()->json(null, 204);
        }else{
            return response()->json(['error' => 'Registro não encontrado'], 404);
        }
    }

}
