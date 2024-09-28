<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class UserController extends Controller
{
    public function mypage(Request $request)
    {
        $user = auth()->user();
        $profile = $user->profile;

        // 出品した商品を取得
        $soldProducts = $user->items()->paginate(10, ['*'], 'soldPage');

        // 購入した商品を取得
        $purchasedProducts = $user->soldItems()->with('item')->paginate(10, ['*'], 'purchasePage');

        return view('mypage', compact('profile', 'soldProducts', 'purchasedProducts'));
    }
}
