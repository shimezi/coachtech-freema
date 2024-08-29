<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;


class LikeController extends Controller
{
    public function likeButton($id)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        
        $item = Item::findOrFail($id);
        $user = auth()->user();

        if ($item->likes->contains('user_id', $user->id)) {
            $item->likes()->where('user_id', $user->id)->delete();
            return redirect()->back()->with('success', 'お気に入りを解除しました。');
        } else {
            $item->likes()->create(['user_id' => $user->id]);
            return redirect()->back()->with('success', 'お気に入りに追加しました。');
        }
    }
}
