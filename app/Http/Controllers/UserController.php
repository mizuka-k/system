<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // ユーザー一覧表示
    public function index(User $user, Request $request) {
        $sort = $request->get('sort');
        if($sort) {
            if($sort === '1') {
                $users = User::orderBy('created_at')->get();
            } elseif($sort === '2') {
                $users = User::orderBy('created_at','DESC')->get();
            } elseif($sort === '3') {
                $users = User::orderBy('name')->get();
            }
        } else {
            $users = User::all();
        }
        
        // $users = User::all();
        $users = User::paginate(10);
        return view('User.index', ['sort' => $sort,'users' => $users]);
    }
    // ユーザー検索
    public function search(Request $request) {
        // テーブルから全てのレコードを取得
        $users = User::query();

        // キーワードから検索処理
        $keyword = $request->input('keyword');
        if(!empty($keyword)) {//$keywordが空ではない場合検索処理を実行
            $users->where('name','LIKE',"%{$keyword}%")
            ->orWhereHas('User',function ($query) use ($keyword) {
                $query->where('email','LIKE',"%{keyword}%");
            })->get();
        }
        $users = User::paginate(10);
        return view('user.index',['users' => $users]);
    }

    // ユーザー情報編集画面表示
    // public function showEdit() {
        
    // }
    // ユーザー情報編集処理
    // public function edit() {
        
    // }
    // ユーザー情報削除
    public function destroy($id) {
        if(empty($id)){
            \Session::flash('err_msg','データがありません。');
            return redirect(route('user.index'));
        }
        try {
            // ユーザー削除処理
            User::destroy($id);
        }catch(\Throwable $e) {
            abort(500);
        }
        return redirect()->route('user.index')->with('successMessage','削除が完了しました。');

        
    }

}
