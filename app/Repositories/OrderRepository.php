<?php

namespace App\Repositories;

use App\Http\Resources\OrderResource;
use App\Interfaces\RepositoryInterface;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderRepository implements RepositoryInterface
{

    public function getAll()
    {
        return Order::with('products')->get();
    }

    public function getById(int $id)
    {
        return Order::with('products')->where(['id' => $id])->get();
    }

    public function create(array $data)
    {
        $productIds = array_column($data['products'], 'id');
        $products = \App\Models\Product::whereIn('id', $productIds)->get();
        $order = \App\Models\Order::create();
        $totalOrderAmount = 0;

        $productsToAttach = [];

        foreach ($data['products'] as $item) {
            $product = $products->firstWhere('id', $item['id']);
            $price = $product->price;
            $amount = $item['amount'];

            $totalOrderAmount += $price * $amount;

            $productsToAttach[$product->id] = ['price' => $price, 'amount' => $amount];
        }

        $order->amount = $totalOrderAmount;
        $order->save();

        $order->products()->attach($productsToAttach);

        return $order->with('products')->first();
    }
}
