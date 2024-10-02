<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;
use App\Http\Requests\ProfileRequest;

class ProfileController extends Controller
{
    // プロフィール編集画面の表示
    public function edit()
    {
        // ログイン中のユーザーのプロフィールを取得
        $profile = Profile::where('user_id', Auth::id())->firstOrNew();
        return view('mypage', compact('profile'));
    }

    // プロフィールの更新処理
    public function update(ProfileRequest $request)
    {

        // プロフィールを取得または新規作成
        $profile = Profile::firstOrNew(['user_id'=> Auth::id()]);

        // フォームデータをプロフィールに適用
        $profile->name = $request->input('name');
        $profile->postcode = $request->input('postcode');
        $profile->address = $request->input('address');
        $profile->building = $request->input('building');

        // 画像のアップロード処理
        if ($request->hasFile('img_url')) {
            $imgPath = $request->file('img_url')->store('profile', 'public');
            $profile->img_url =$imgPath;
        }

        // プロフィールの保存
        $profile->save();

        // マイページにリダイレクトしてメッセージを表示
        return redirect()->route('mypage')->with('success', 'プロフィールを更新されました。');
    }
}
