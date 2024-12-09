<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    // 商品一覧表示
    public function index(Request $request) {
        $keyword = $request->input('keyword');
        $type = $request->input('type');

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

        return view('search.index', compact(['items','keyword','type','itemCount','sortField','sortOrder']));
    }
    // 商品詳細ページ表示
    public function show(Item $item) {

        return view('search.show', compact('item'));
    }
}
