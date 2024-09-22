<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AdminLoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function login(AdminLoginRequest $request)
    {
        // 認証の試行
        if (auth()->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            // 認証に成功した場合、ダッシュボードにリダイレクト
            return redirect()->route('admin.dashboard');
        }

        // 認証に失敗した場合、エラーメッセージをセッションに保存して再度ログインフォームを表示
        return back()->withErrors([
            'email' => 'メールアドレスまたはパスワードが間違っています。',
        ])->withInput(); // メールアドレスを保持しない
    }

    public function showLogin()
    {
        return view('admin.login');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }
}
