<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function  store(Request $request, $id)
    {
        // バリデーション
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        // アイテムを取得
        $item = Item::findOrFail($id);
        $user = auth()->user();

         // コメントの作成
         $item->comments()->create([
            'user_id' => auth()->id(),  // ログイン中のユーザーIDを設定
            'comment' => $request->comment,
        ]);

        // フォームの表示をリセット
        session()->forget('show_comment-form');

        // リダイレクトしてメッセージを表示
        return redirect()->route('item.show', ['id' => $id])->with('success', 'コメントが投稿されました。');
    }

    // コメントフォームの表示を制御するメソッド
    public function showForm($id)
    {
        // セッションにフォームの表示フラグを設定
        session(['show_comment-form' => true]);

        // リダイレクトしてフォームを表示させる
        return redirect()->route('item.show', ['id' => $id]);
    }

    public function index()
    {
        $comments = Comment::all(); // すべてのコメントを取得
        return view('admin.manage_comments', compact('comments')); // ビューに渡す
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id); // コメントを取得
        $comment->delete(); // コメントを削除

        return redirect()->route('admin.comments.index')->with('success', 'コメントが削除されました。');
    }
}
