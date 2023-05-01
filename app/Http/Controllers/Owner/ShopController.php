<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use InterventionImage;
use App\Http\Requests\UploadImageRequest;
use App\Services\ImageService;

class ShopController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:owners');

        $this->middleware(function ($request, $next) {
            // dd($request->route()->parameter('shop')); //URLのshopキーの値を取得する ※文字列型
            //dd(Auth::id()); //※数字

            $id = $request->route()->parameter('shop');
            if(!is_null($id)){ //indexURLのときはnullなので、その判定を行う
                $shopsOwnerId = Shop::findOrFail($id)->owner->id; //login ownerのidを取得
                $shopId =(int)$shopsOwnerId; //キャスト 文字列を数字に変換
                $ownerId = Auth::id();
                if($shopId !== $ownerId){ //一致していなければ404画面を表示
                    abort(404);
                }
            }
            return $next($request);
        });
    }

    public function index()
    {
        $ownerId = Auth::id();
        $shops = Shop::where('owner_id', $ownerId)->get(); //Shop ModelをownerIdで検索して、取得したものをget

        return view('owner.shops.index',
        compact('shops'));
    }

    public function edit(string $id)
    {
        // dd(Shop::findOrFail($id));

        $shop = Shop::findOrFail($id);
        return view('owner.shops.edit', compact('shop'));
    }

    public function update(UploadImageRequest $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'information' => ['required', 'string', 'max:1000'],
            'is_selling' => ['required'],
        ]);

        $imageFile = $request->image;
        if(!is_null($imageFile) && $imageFile->isValid()){
            $fileNameToStore = ImageService::upload($imageFile,'shops');
        }

        $shop = Shop::findOrFail($id);
        $shop->name = $request->name;
        $shop->information = $request->information;
        $shop->is_selling = $request->is_selling;
        if(!is_null($imageFile) && $imageFile->isValid()){
            $shop->filename = $fileNameToStore;
        }

        $shop->save();

        return redirect()
        ->route('owner.shops.index')
        ->with(['message' => '店舗情報を更新しました。',
        'status' => 'info']);
    }
}
