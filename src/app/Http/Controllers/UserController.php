<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function mypage()
    {
        $user = auth()->user();
        $profile = $user->profile;

        // 出品した商品を取得
        $soldItems = $user->soldItems->map(function ($soldItem) {
            return $soldItem->item;
        });

        // 購入した商品を取得
        $purchasedItems = $user->soldItems->map(function ($soldItem) {
            return $soldItem->item;
        });

        return view('mypage', compact('profile', 'soldItems', 'purchasedItems'));
    }

    public function soldProducts()
    {
        $items = auth()->user()->items()->paginate(10); // 出品したアイテム
        return view('mypage', compact('items'));
    }

    public function purchasedProducts()
    {
        $items = auth()->user()->soldItems()->paginate(10); // 購入したアイテム
        return view('mypage', compact('items'));
    }
}
