<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:users');

        $this->middleware(function ($request, $next) {
            $id = $request->route()->parameter('item');
            if(!is_null($id)){
                $itemId = Product::availableItems()->where('products.id', $id)->exists(); //existsで入ってきたidがwhereの結果で存在しているか確認して入っていたらtrue返す
                if(!$itemId){
                    abort(404);
                }
            }
            return $next($request);
        });
    }
    
    public function index()
    {
        $products = Product::availableItems()->get(); //商品一覧の取得 scope
        
        return view('user.index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);

        $quantity = Stock::where('product_id',$product->id)
        ->sum('quantity');

        if($quantity > 9){
            $quantity = 9;
        }

        return view('user.show', 
        compact('product', 'quantity'));
    }
}
