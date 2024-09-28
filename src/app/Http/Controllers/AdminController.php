<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AdminLoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\SendEmailRequest;
use Illuminate\Support\Facades\Log;
use App\Mail\UserNotificationMail;

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
        $user = auth()->user(); // 現在のユーザーを取得
        return view('admin.dashboard', compact('user'));
    }

    public function index()
    {
        $users = User::paginate(10);
        return view('admin.manage_users', compact('users'));
    }

    public function destroy($id)
    {
        // ユーザーを削除
        $user = User::findOrFail($id); // ユーザーを取得
        if ($user->is_admin) {
            return redirect()->route('admin/manage-users')->with('error', '管理者ユーザーは削除できません。');
        }

        // ユーザーを削除
        $user->delete();

        // 成功メッセージをセッションに保存
        return redirect()->route('admin.users.index')->with('success', 'ユーザーが削除されました。');
    }

    /**
     * メール送信フォームを表示するメソッド
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function showMailForm($id)
    {
        $user = User::FindOrFail($id);
        return view('emails.user_notification', compact('user'));
    }

    /**
     * メール送信を処理するメソッド
     *
     * @param \App\Http\Requests\SendEmailRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendEmail(SendEmailRequest $request)
    {
        $email = $request->email; // リクエストからメールアドレスを取得
        $message = $request->message; // メッセージを取得

        // ユーザー情報を取得
        $user = User::where('email', $email)->first(); // ここでユーザーを取得

        try {

            Mail::to($email)->send(new UserNotificationMail($user, $message));

            return redirect()->route('admin.users.index')->with('success', 'メールが送信されました。');
        } catch (\Exception $e) {
            // エラーをログに記録し、ユーザーに表示
            Log::error('メール送信中にエラーが発生しました: ' . $e->getMessage());
            return redirect()->back()->with('error', 'メール送信中にエラーが発生しました。詳細: ' . $e->getMessage());
        }
    }
}
