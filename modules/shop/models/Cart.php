<?php
declare(strict_types=1);

namespace app\modules\shop\models;


use yii\db\ActiveRecord;

class Cart extends ActiveRecord
{
    public function addToCart($product, $qty = 1)
    {

        if (isset($_SESSION['cart'][$product->id])) {
            $_SESSION['cart'][$product->id]['qty'] += $qty;
        } else {
            $_SESSION['cart'][$product->id] = [
                'qty' => $qty,
                'name' => $product->name,
                'price' => $product->amount->price,
                'image' => $product->detail->image,
            ];

        }
        $_SESSION['cart.qty'] = isset($_SESSION['cart.qty']) ? $_SESSION['cart.qty'] + $qty : $qty;
        $_SESSION['cart.sum'] = isset($_SESSION['cart.sum']) ? $_SESSION['cart.sum'] + $qty * $product->amount->price : $qty * $product->amount->price;
    }

    public function recalc(int $id)
    {
        if (!isset($_SESSION['cart'][$id])) {
            return false;
        }
        $qtyMinus = $_SESSION['cart'][$id]['qty'];
        $sumMinus = $_SESSION['cart'][$id]['qty'] * $_SESSION['cart'][$id]['price'];
        $_SESSION['cart.qty'] -= $qtyMinus;
        $_SESSION['cart.sum'] -= $sumMinus;
        unset($_SESSION['cart'][$id]);

    }


}