<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\Condition;
use App\Models\Profile;
use App\Models\SoldItem;
use App\Models\User;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        // $items = Item::all();
        $items = Item::paginate(10); // 1ページあたり10個のアイテムを表示

        return view('index', compact('items'));
    }

    public function show($id)
    {
        $item = Item::with('condition', 'categories', 'comments.user', 'likes')->findOrFail($id);

        return view('item', compact('item'));
    }

    public function createSell()
    {
        // カテゴリー一覧を取得
        $categories = Category::all();

        // コンディション一覧を取得
        $conditions = Condition::all();

        return view('sell', compact('categories', 'conditions'));
    }

    public function storeSell(Request $request)
    {

        // バリデーションと保存処理
        $validated = $request->validate([
            'img_url' => 'required|image',
            'category_ids' => 'required|array', // 配列としてバリデーション
            'category_ids.*' => 'exists:categories,id', // 配列としてバリデーション
            'condition_id' => 'required|exists:conditions,id',
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
        ]);

        // バリデーション済みデータを使用して処理
        $item = new Item();
        $item->img_url = $request->file('img_url')->store('items', 'public');
        $item->condition_id = $request->input('condition_id');
        $item->name = $request->input('name');
        $item->description = $request->input('description');
        $item->price = $request->input('price');
        $item->user_id = auth()->id(); // 現在ログインしているユーザーのIDを設定
        $item->save();

        // 選択されたカテゴリーを関連付け
        $item->categories()->attach($request->input('category_ids'));

        return redirect()->route('index');
    }

    // アイテム購入ページの表示
    public function createPurchase($id)
    {
        $item = Item::findOrFail($id);

        return view('purchase', compact('item'));
    }

    public function storePurchase(Request $request, $id)
    {
        // アイテムを取得
        $item = Item::findOrFail($id);

        // ユーザーのプロフィール情報を取得
        $user = auth()->user();
        $profile = $user->profile; // ここでプロフィール情報を取得する（プロフィールがユーザーとリレーションしている前提）

        if (!$profile) {
            // プロフィールが存在しない場合の処理
            // 例: エラーメッセージを設定し、リダイレクトする
            return redirect()->back()->withErrors(['profile' => 'プロフィール情報がありません。']);
        }

        // 購入処理を実行
        $soldItem = new SoldItem();
        $soldItem->item_id = $item->id;
        $soldItem->user_id = $user->id;
        // プロフィールからデフォルトの住所情報を取得して、保存する必要がある場合は他の方法で処理
        // ここでは住所情報は sold_items テーブルには保存しません
        // 代わりにプロフィールの情報は別途使用するために参照します
        $soldItem->save();

        // 保存後のリダイレクトやレスポンス処理
        return redirect()->route('mypage'); // 購入成功後のリダイレクト先（例: 購入完了ページ）
    }

    // 住所登録ページの表示
    public function address($id)
    {
        $item = Item::findOrFail($id);
        $user = auth()->user();

        if ($user->address) {
            return redirect()->route('purchase.store', ['id' => $id]);
        }
        // ビューに item を渡す
        return view('purchase', ['item' => $item])->with('viewSection', 'address');
    }

    public function storeAddress(Request $request, $id)
    {
        // バリデーション
        $request->validate([
            'postcode' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        // アイテムを取得
        $item = Item::findOrFail($id);

        // ユーザーのプロフィールを取得または作成
        $profile = Profile::firstOrNew(['user_id' => auth()->id()]);

        // 住所をプロフィールに設定
        $profile->address = $request->input('address');
        $profile->postcode = $request->input('postcode');

        // プロフィールを保存
        $profile->save();

        // 保存後のリダイレクトやレスポンス処理
        return redirect()->route('purchase.store', ['id' => $id]);
    }
}
