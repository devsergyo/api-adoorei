<?php

namespace App\Http\Controllers\Api\Order;

use App\Actions\Order\Cancel as CancelOrderAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\CancelRequest;
use App\Http\Resources\OrderResource;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CancelController extends Controller
{

    private CancelOrderAction $orderCancelAction;
    public function __construct(CancelOrderAction $orderCancelAction)
    {
        $this->orderCancelAction = $orderCancelAction;
    }
    public function __invoke(CancelRequest $request)
    {
        $order = ($this->orderCancelAction)($request->validated());

        if ($order){
            return response()->json(null, 204);
        }else{
            return response()->json(['error' => 'Registro não encontrado'], 404);
        }
    }

}
