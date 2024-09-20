<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AdminRegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function register(AdminRegisterRequest $request)
    {
        $admin = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => true, // 管理者フラグを立てる
        ]);

        return redirect()->route('admin.dashboard'); // ダッシュボードにリダイレクト
    }
}
