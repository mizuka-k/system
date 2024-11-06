<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class SearchController extends Controller
{
    // 商品一覧表示
    public function index() {
        $items = Item::all();
        return view('search.index', compact('items'));
    }
}
