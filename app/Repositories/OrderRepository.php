<?php

namespace App\Repositories;

use App\Interfaces\RepositoryInterface;
use App\Models\Order;


class OrderRepository implements RepositoryInterface
{
    /**
     * Retorna todos os pedidos com os produtos associados.
     * @return mixed
     */
    public function getAll()
    {
        return Order::with('products')->get();
    }

    /**
     * Retorna um pedido específico pelo ID com os produtos associados.
     * @param int $id
     * @return mixed
     */
    public function getById(int $id)
    {
        return Order::with('products')->where(['id' => $id])->get();
    }

    /**
     * Cria um novo pedido com os produtos fornecidos.
     * @param array $data
     * @return mixed
     */
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

    /**
     * Adiciona ou atualiza produtos a um pedido existente.
     * @param int $orderId
     * @param array $productData
     * @return mixed
     */
    public function addProductsToOrder(int $orderId, array $productData)
    {
        $order = \App\Models\Order::findOrFail($orderId);
        $productIds = array_column($productData, 'id');
        $products = \App\Models\Product::whereIn('id', $productIds)->get();

        foreach ($productData as $item) {
            $existingProduct = $order->products()->where('product_id', $item['id'])->first();

            if ($existingProduct) {
                // Atualiza a quantidade e valores atuais
                $existingProduct->pivot->amount = $item['amount'];
                $existingProduct->pivot->price = $products->firstWhere('id', $item['id'])->price;
                $existingProduct->pivot->save();
            } else {
                // Adiciona um novo produto
                $product = $products->firstWhere('id', $item['id']);
                $order->products()->attach($product, ['price' => $product->price, 'amount' => $item['amount']]);
            }
        }

        // Atualiza o valor total do pedido
        $order->amount = $order->products->sum(function ($product) {
            return $product->pivot->price * $product->pivot->amount;
        });
        $order->save();

        // Retorna o pedido com os produtos atualizados
        return $order->load('products');
    }

    /**
     * Cancela um pedido existente, alterando o status para "canceled".
     * @param int $id
     * @return mixed
     */
    public function cancel(int $id)
    {
        $order = Order::find($id);
        $order->status = "canceled";
        $order->save();
        return $order->load('products');
    }
}
