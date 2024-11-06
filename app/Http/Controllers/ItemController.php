<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Validation\Validator;

class ItemController extends Controller
{
    // 商品一覧画面表示
    public function index() {
        $items = Item::all();
        return view('item.index', compact('items'));
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
}
