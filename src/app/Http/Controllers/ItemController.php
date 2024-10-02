<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\Condition;
use App\Models\Profile;
use App\Models\SoldItem;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\ItemStoreRequest;
use App\Http\Requests\ItemUpdateRequest;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::paginate(10); // 1ページあたり10個のアイテムを表示

        return view('index', compact('items'));
    }

    public function show($id)
    {
        $item = Item::with('condition', 'categories', 'comments.user', 'likes')->findOrFail($id);

        // ログインユーザーが商品の所有者である場合、編集ページにリダイレクト
        if (auth()->check() && auth()->id() == $item->user_id) {
            return redirect()->route('item.edit', ['id' => $item->id]);
        }

        return view('item', compact('item'));
    }

    public function edit($id)
    {
        $item = Item::with('categories')->findOrFail($id);

        // ログインユーザーが商品の所有者であることを確認
        if (auth()->id() != $item->user_id) {
            return redirect()->route('item.show', ['id' => $item->id])->with('error', '編集する権限がありません。');
        }

        $categories = Category::all();
        $conditions = Condition::all();

        return view('sell', compact('item', 'categories', 'conditions'));
    }

    public function update(ItemUpdateRequest $request, $id)
    {
        $item = Item::findOrFail($id);

        // ログインユーザーが商品の所有者であることを確認
        if (auth()->id() != $item->user_id) {
            return redirect()->route('item.sho', ['id' => $item->id])->with('error', '更新する権限がありません。');
        }

        // 商品情報の更新
        $item->condition_id = $request->input('condition_id');
        $item->name = $request->input('name');
        $item->description = $request->input('description');
        $item->price = $request->input('price');

        // 画像の更新処理
        if ($request->hasFile('img_url')) {
            // 既存の画像を削除
            if ($item->img_url && Storage::disk('public')->exists($item->img_url)) {
                Storage::disk('public')->delete($item->img_url);
            }
            // 新しい画像を保存
            $item->img_url = $request->file('img_url')->store('items', 'public');
        }

        $item->save();

        // カテゴリーの更新
        $item->categories()->sync($request->input('category_ids'));

        return redirect()->route('mypage')->with('success', '商品情報を更新しました。');
    }


    public function createSell()
    {
        // カテゴリー一覧を取得
        $categories = Category::all();

        // コンディション一覧を取得
        $conditions = Condition::all();

        return view('sell', compact('categories', 'conditions'));
    }

    public function storeSell(ItemStoreRequest $request)
    {

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

        return redirect()->route('mypage');
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
            return redirect()->route('profile.edit') // プロフィール登録フォームのルート
                ->withErrors(['profile' => '商品を購入するにはプロフィールを登録してください。']);
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
