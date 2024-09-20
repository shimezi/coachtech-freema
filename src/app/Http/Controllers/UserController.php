<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function mypage()
    {
        $user = auth()->user();
        $profile = $user->profile;

        // 出品した商品を取得
        $soldProducts = $user->items()->get();

        // 購入した商品を取得
        $purchasedProducts = $user->soldItems()->get();

        return view('mypage', compact('profile', 'soldProducts', 'purchasedProducts'));
    }

    public function soldProducts()
    {
        $user = auth()->user();
        $items = $user->soldProducts()->paginate(10);

        return view('mypage', ['items' => $items]);
    }

    public function purchasedProducts()
    {
        $user = auth()->user();
        $items = $user->purchasedProducts()->paginate(10);

        return view('mypage', ['items' => $items]); // これを修正
    }
}
