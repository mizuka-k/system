<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //HOME画面表示
    public function home() {
        return view('home');
    }
}
