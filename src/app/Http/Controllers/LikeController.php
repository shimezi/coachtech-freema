<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Like;
use App\Models\User;
use Facade\FlareClient\View;

class LikeController extends Controller
{
    public function like($id)
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

    public function likeItems()
    {
        if (auth()->check()) {
            $user = auth()->user();
            $items = $user->likedItems()->paginate(10);
            return view('index', ['items' => $items]);
        } else {
            return redirect()->route('index')->with('error', 'ログインしてください。');
        }
    }
}
