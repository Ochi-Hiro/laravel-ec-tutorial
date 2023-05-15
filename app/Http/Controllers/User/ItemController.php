<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Support\Facades\DB;
use App\Models\PrimaryCategory;

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
    
    public function index(Request $request)
    {
        // dd($request);

        $categories = PrimaryCategory::with('secondary') //EagerLoading
        ->get();

        $products = Product::availableItems() //商品一覧の取得 scope
        ->sortOrder($request->sort)
        ->paginate($request->pagination ?? '20');
        
        return view('user.index', 
        compact('products', 'categories'));
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
