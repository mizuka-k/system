<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailVerificationController;



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

// メール認証
Route::controller(EmailVerificationController::class)
->prefix('email')->name('verification.')->group(function () {
    // 確認メール送信画面
    Route::get('verify', 'index')->name('notice');
    // 確認メール送信
    Route::post('verification-notification', 'notification')
            ->middleware('throttle:6,1')->name('send');
    // 確認メールリンクの検証
    Route::get('verification/{id}/{hash}', 'verification')
            ->middleware(['signed','throttle:6,1'])->name('verify');
});


// ログイン画面表示
Route::get('/', [App\Http\Controllers\AccountController::class,'showLogin'])->name('login');
// ログイン処理
Route::post('/login', [App\Http\Controllers\AccountController::class,'authenticate'])->name('authenticate');
// ログアウト
Route::get('/logout', [App\Http\Controllers\AccountController::class,'logout'])->name('logout');


// ログインユーザーのみ閲覧可能
Route::group(['middleware' => ['auth', 'verified']], function() {

    // ホーム画面表示
    Route::get('/home', [App\Http\Controllers\HomeController::class,'home'])->name('home');
    // マイページ表示
    Route::get('/account/profile/{id}', [App\Http\Controllers\AccountController::class,'profile'])->name('profile');
    // マイページ編集画面表示
    Route::get('/account/profile/edit/{id}', [App\Http\Controllers\AccountController::class,'showEdit'])->name('showEdit');
    // マイページ編集
    Route::patch('/account/profile/update/{id}', [App\Http\Controllers\AccountController::class,'profileUpdate'])->name('profileUpdate');
    // 商品一覧（すべてのユーザーが閲覧可能)
    Route::get('/search/index',[App\Http\Controllers\SearchController::class,'index'])->name('search.index');
    // 商品詳細（すべてのユーザーが閲覧可能)
    Route::get('/search/show/{item}',[App\Http\Controllers\SearchController::class,'show'])->name('search.show');



    // 管理者ユーザーのみ閲覧可能-todo:管理者ユーザーの制限かける
    // ユーザー一覧
    Route::get('/user/index', [App\Http\Controllers\UserController::class,'index'])->name('user.index');
    // ユーザー検索
    Route::get('/user/search', [App\Http\Controllers\UserController::class,'search'])->name('user.search');
    // ユーザー情報編集画面表示
    Route::get('/user/showEdit/{user}', [App\Http\Controllers\UserController::class,'edit'])->name('user.edit');
    // ユーザー情報編集処理
    Route::patch('/user/edit/{user}', [App\Http\Controllers\UserController::class,'update'])->name('user.update');
    // ユーザー情報削除
    Route::delete('/user/delete/{id}}', [App\Http\Controllers\UserController::class,'destroy'])->name('user.delete');

    // 商品一覧
    Route::get('/item/index', [App\Http\Controllers\ItemController::class,'index'])->name('item.index');
    // 商品登録画面表示
    Route::get('/item/create', [App\Http\Controllers\ItemController::class,'create'])->name('item.create');
    // 商品登録
    Route::post('/item/store', [App\Http\Controllers\ItemController::class,'store'])->name('item.store');
    // 商品詳細画面表示
    Route::get('/item/show/{item}', [App\Http\Controllers\ItemController::class,'show'])->name('item.show');
    // 
    // 商品編集処理
    Route::patch('/item/edit/{item}', [App\Http\Controllers\ItemController::class,'update'])->name('item.update');
    // 商品削除
    Route::delete('/item/delete/{item}}', [App\Http\Controllers\ItemController::class,'destroy'])->name('item.delete');

        // 商品一覧表示
    //     Route::get('/search/index', [App\Http\Controllers\SearchController::class,'index'])->name('search.index');
});


// パスワード再設定用のメール送信フォーム表示
// Route::get('/reset', [App\Http\Controllers\UserController::class,'requestResetPassword'])->name('reset.form');
// メール送信処理
// Route::post('/reset/send', [App\Http\Controllers\UserController::class,'sendResetPasswordMail'])->name('reset.send');
// メール送信完了画面表示
// Route::get('/reset/send/complete', [App\Http\Controllers\UserController::class,'sendCompleteResetPasswordMail'])->name('reset.send.complete');
// パスワード再設定画面表示
// Route::get('/reset/edit', [App\Http\Controllers\UserController::class,'resetPasswordMail'])->name('reset.password.edit');
// パスワード更新処理
// Route::post('/reset/update', [App\Http\Controllers\UserController::class,'updatePassword'])->name('reset.password.update');


// パスワードリセットリンクリクエストフォーム
Route::get('/forgot-password', [App\Http\Controllers\UserController::class,'requestResetPassword'])
    ->middleware('guest')->name('password.request');

// リセットリンクリクエストメール送信処理
Route::post('/forgot-password', [App\Http\Controllers\UserController::class,'sendResetPasswordMail'])
    ->middleware('guest')->name('password.email');

// パスワードリセットフォーム表示
Route::get('/reset-password/{token}', [App\Http\Controllers\UserController::class,'passwordReset'])
    ->middleware('guest')->name('password.reset');

// パスワードの更新処理
Route::post('/reset-password', [App\Http\Controllers\UserController::class,'passwordUpdate'])
    ->middleware('guest')->name('password.update');

