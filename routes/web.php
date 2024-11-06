<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
});

// 会員登録画面表示
Route::get('/account/register', [App\Http\Controllers\AccountController::class,'register'])->name('register');
// 会員登録処理
Route::post('account/store', [App\Http\Controllers\AccountController::class,'store'])->name('accountStore');

// ログイン画面表示
Route::get('/', [App\Http\Controllers\AccountController::class,'showLogin'])->name('login');
// ログイン処理
Route::post('/login', [App\Http\Controllers\AccountController::class,'authenticate'])->name('authenticate');
// ログアウト
Route::get('/logout', [App\Http\Controllers\AccountController::class,'logout'])->name('logout');


// ログインユーザーのみ閲覧可能
Route::group(['middleware' => 'auth'], function() {

    // ホーム画面表示
    Route::get('/home', [App\Http\Controllers\HomeController::class,'home'])->name('home');
    // マイページ表示
    Route::get('/account/profile/{id}', [App\Http\Controllers\AccountController::class,'profile'])->name('profile');
    // マイページ編集画面表示
    Route::get('/account/profile/edit/{page}', [App\Http\Controllers\AccountController::class,'showEdit'])->name('showEdit');
    // マイページ編集
    Route::patch('/account/profile/update/{page}', [App\Http\Controllers\AccountController::class,'profileUpdate'])->name('profileUpdate');


    // 商品一覧表示
    Route::get('/search/index', [App\Http\Controllers\SearchController::class,'index'])->name('search.index');
});

// 管理者ユーザーのみ閲覧可能

// ユーザー一覧
Route::get('/user/index', [App\Http\Controllers\UserController::class,'index'])->name('user.index');
// ユーザー検索
Route::get('/user/search', [App\Http\Controllers\UserController::class,'search'])->name('user.search');
// ユーザー情報編集
// ユーザー情報削除

// 商品一覧
Route::get('/item/index', [App\Http\Controllers\ItemController::class,'index'])->name('item.index');
// 商品登録画面表示
Route::get('item/create', [App\Http\Controllers\ItemController::class,'create'])->name('item.create');
// 商品登録
Route::post('item/store', [App\Http\Controllers\ItemController::class,'store'])->name('item.store');
// 商品詳細画面表示
Route::get('item/show/{item}', [App\Http\Controllers\ItemController::class,'show'])->name('item.show');
// 商品編集処理
// 商品削除