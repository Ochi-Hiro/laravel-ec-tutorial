<?php

namespace App\Services;
use App\models\Product;
use App\models\Cart;

class CartService
{
    public static function getItemsInCart($items)
    {
        $products = [];
        
        foreach($items as $item){
            $p = Product::findOrFail($item->product_id);
            $owner = $p->shop->owner->select('name', 'email')->first()->toArray(); //オーナー情報1件目取得し配列に変換
            $values = array_values($owner); //連想配列の値のみ取得
            $keys = ['ownerName', 'email']; //キーの名前nameがproductと被るのでownerNameと設定
            $ownerInfo = array_combine($keys, $values); //オーナー情報の変更したキーと元のvalueを結合する
            $product = Product::where('id', $item->product_id)
                ->select('id', 'name', 'price')->get()->toArray(); //商品情報の配列生成
            $quantity = Cart::where('product_id', $item->product_id)
                ->select('quantity')->get()->toArray(); //在庫数の配列生成
            // dd($ownerInfo, $product, $quantity);
            
            $result = array_merge($product[0], $ownerInfo, $quantity[0]); //配列の結合,productとquantityは配列の中に配列で取得されるので[0]指定する
            // dd($result);

            array_push($products, $result); //用意していたproducts配列にresultを追加する
        }

        dd($products);
        return $products;
    }
}