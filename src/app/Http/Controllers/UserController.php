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

        $soldItems = $user->sold;
        $purchasedItems = $user->purchases;

        return view('mypage', compact('profile', 'soldItems', 'purchasedItems'));
    }
}
