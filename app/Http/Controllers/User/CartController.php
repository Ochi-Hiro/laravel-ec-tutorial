<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\User;
use App\Models\Stock;
use Illuminate\Support\Facades\Auth;
use Stripe;

class CartController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(Auth::id());
        $products = $user->products; //ユーザーに紐づく全ての商品を取得
        $totalPrice = 0;

        foreach($products as $product){
            $totalPrice += $product->price * $product->pivot->quantity;
        }

        // dd($products, $totalPrice);

        return view('user.cart',
            compact('products', 'totalPrice'));
    }

    public function add(Request $request)
    {

        $itemInCart = Cart::where('product_id', $request->product_id)
        ->where('user_id', Auth::id())->first();

        if($itemInCart){
            $itemInCart->quantity += $request->quantity;
            $itemInCart->save();
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'quantity' => $request->quantity
            ]);
        }
        
        return redirect()->route('user.cart.index');
        //カートに商品を入れたらカート画面に移動する
    }

    public function delete($id)
    {
        Cart::where('product_id', $id)
        ->where('user_id', Auth::id())
        ->delete();

        return redirect()->route('user.cart.index');
    }

    public function checkout()
    {
        $user = User::findOrFail(Auth::id());
        $products = $user->products;

        $lineItems = [];
        foreach($products as $product){
            $quantity = '';
            $quantity =Stock::where('product_id', $product->id)->sum('quantity');

            if($product->pivot->quantity > $quantity){
                return redirect()->route('user.cart.index'); //cart内の商品がStockテーブルより多かったらindexへ戻す
            } else {
                $lineItem = [
                    "price_data" =>[ //Stripeに渡すパラメータの設定
                        "unit_amount" => $product->price, //金額
                        "currency" => "JPY", //通過、日本円
                        "product_data"=> [
                            "name" =>$product->name, //商品名
                            "description" => $product->information,
                        ],
                    ],
                    "quantity" => $product->pivot->quantity, //数量
                ];
    
                array_push($lineItems, $lineItem); //lineItemをlineItems配列に追加する。array_pushはPHP関数

            }
        }
        // dd($lineItems);

        foreach($products as $product){
            Stock::create([
                'product_id' => $product->id,
                'type' => \Constant::PRODUCT_LIST['reduce'],
                'quantity' => $product->pivot->quantity * -1
            ]);
        }
        // dd('test');

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY')); //envファイルからシークレットキーを設定
        $session = \Stripe\Checkout\Session::create([ //StripeSession
            'payment_method_types' => ['card'],
            'line_items' => [$lineItems],
            'mode' => 'payment',
            'success_url' => route('user.cart.success'),
            'cancel_url' => route('user.cart.index'),
        ]);

        return redirect($session->url, 303);
    }

    public function success()
    {
        Cart::where('user_id', Auth::id())->delete();

        return redirect()->route('user.items.index');
    }
}