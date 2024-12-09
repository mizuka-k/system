<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class HomeController extends Controller
{
    //HOME画面表示
    public function home() {
        $items = Item::orderBy('updated_at','desc')->take(5)->get();
        return view('home',compact('items'));
    }
}
