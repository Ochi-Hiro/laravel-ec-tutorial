<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function __constuct()
    {
        $this->middleware('auth:owners');
    }

    public function index()
    {
        $ownerId = Auth::id();
        $shops = Shop::where('owner_id', $ownerId)->get(); //Shop ModelをownerIdで検索して、取得したものをget

        return view('owner.shops.index',
        compact('shops'));
    }

    public function edit(string $id)
    {}

    public function update(Request $request, string $id)
    {}
}
