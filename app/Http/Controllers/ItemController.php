<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Validation\Validator;
use \Illuminate\Support\Facades\Auth; 

class ItemController extends Controller
{
    // 商品一覧画面表示
    public function index(Request $request) {
        $keyword = $request->input('keyword');
        $type = $request->input('type');
        // $items = Item::all();
        $query = Item::query();
        if($keyword) {
            $query->where('name', 'LIKE', "%{$keyword}%");
        }
        if($type) {
            $query->where('type', $type);
        }

        $sortField = $request->input('sort', 'id');
        $sortOrder = $request->input('order', 'asc');

        $items = $query ->orderBy($sortField, $sortOrder)
                        ->paginate(10)
                        ->appends($request->only(['sort', 'order','keyword','type']));

        $itemCount =  $query->count();

        return view('item.index', compact(['items','keyword','type','itemCount','sortField','sortOrder']));
    }
    // 商品登録画面表示
    public function create() {
        return view('item.create');
    }
    // 商品登録処理
    public function store(Request $request) {
        $items = $request->validate([
            'name' => 'required|max:100',
            'type' => 'required',
            'detail' => 'required|max:500',
            'price' => 'required',
        ],
        [
            'name.required' => '商品名は必須です。',
            'name.max' => '商品名は100文字以下で入力してください。',
            'type.required' => 'カテゴリーは必須です。',
            'detail.required' => '商品説明は必須です。',
            'detail.max' => '商品説明は500文字以下で入力してください。',
            'price.required' => '価格は必須です。',
        ]);

        $item = new Item();
        $item->name = $items['name'];
        $item->type = $items['type'];
        $item->detail = $items['detail'];
        $item->price = $items['price'];
        $item->user_id = auth()->user()->id;

        if(request('image')) {
            $original = $request->file('image')->getClientOriginalName();
            $name = date('Ymd_His').'_'.$original;
            request()->file('image')->move('storage/images',$name);
            $item->image =$name;
        }
        $item->save();
        return redirect()->route('item.index')->with('successMessage','保存しました。');
    }
    
    // 商品詳細ページ表示
    public function show(Item $item) {
        return view('item.show', compact('item'));
    }

    // 商品編集処理
    public function update(Request $request,Item $item) {
        $validated = $request->validate([
            'name' => 'required|max:100',
            'type' => 'required',
            'detail' => 'required|max:500',
            'price' => 'required',
        ],
        [
            'name.required' => '商品名は必須です。',
            'name.max' => '商品名は100文字以下で入力してください。',
            'type.required' => 'カテゴリーは必須です。',
            'detail.required' => '商品説明は必須です。',
            'detail.max' => '商品説明は500文字以下で入力してください。',
            'price.required' => '価格は必須です。',
        ]);

        if(request('image')) {
            $original = $request->file('image')->getClientOriginalName();
            $name = date('Ymd_His').'_'.$original;
            request()->file('image')->move('storage/images',$name);
            $item->image =$name;
        }
        $validated['user_id'] = auth()->user()->id;
        dd($validated);
        $item->update($validated);
        return redirect()->route('item.show',$item)->with('successMessage','商品を更新しました。');
}
    // 商品削除
    public function destroy(Item $item) {
        $item->delete();
        return redirect()->route('item.index')->with('successMessage','商品を削除しました。');
    }
}