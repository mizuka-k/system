<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Http\Requests\ResetInputMailRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Exception;



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
        $query = User::query();

        $userCount =  $query->count();

        // キーワードから検索処理
        $keyword = $request->input('keyword');
        if(!empty($keyword)) {//$keywordが空ではない場合検索処理を実行
            $query->where('name','LIKE',"%{$keyword}%");
            // $query->where('email','LIKE',"%{$keyword}%");
        }
        $sortField = $request->input('sort', 'id');
        $sortOrder = $request->input('order', 'asc');

        $users = $query ->orderBy($sortField, $sortOrder)
        ->paginate(10)
        ->appends($request->only(['sort', 'order','keyword','email','name']));

        return view('user.index',compact(['users','keyword','userCount','sortField','sortOrder']));
    }

    // ユーザー情報編集画面表示
    public function edit(User $user) {
        return view('user.edit',compact('user'));
    }
    // ユーザー情報編集処理
    public function update(Request $request ,User $user) {
        $validated = $request->validate([
            'name' => 'required|string|max:100|alpha_num',
            'email' => 'required', 'string', 'email:strict', 'max:255', 'unique:users,email,'.$user->email.',email',
            'role' => 'required',
        ],
        [
            'name.required' => '名前は必須です。',
            'name.max' => '名前は100文字以下で入力してください。',
            'name.alpha_num' => '記号は使用できません。',
            'email.required' => 'メールアドレスは必須です。',
            'email' => '有効なメールアドレスではありません。',
            'email.unique' => 'このメールアドレスはすでに使用されています。',
        ]);
        
        $user->update($validated);
        return back()->with('successMessage','更新しました。');
    }
    // ユーザー情報削除
    public function destroy($id) {
        if(empty($id)){
            return redirect(route('user.index'))->with('errorMessage','データがありません。');
        }
        try {
            // ユーザー削除処理
            User::destroy($id);
        }catch(\Throwable $e) {
            abort(500);
        }
        return redirect()->route('user.index')->with('successMessage','削除が完了しました。');

    }

    /**
     * パスワードリセット
     */
    // パスワード再設定用のメール送信フォーム表示
    public function requestResetPassword() 
    {
        return view('auth.forgot-password');
    }

    // メール送信処理
    public function sendResetPasswordMail(Request $request) 
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }
    // パスワードリセットフォーム表示
    public function passwordReset(string $token)
    {
        return view('auth.reset-password' , ['token' => $token]);
    }

    // 受信リクエストのバリデーションとパスワード更新処理
    public function passwordUpdate(Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required',
            'password' => 'required|string|min:6|confirmed|regex:/\A(?=.*?[a-z])(?=.*?\d)(?=.*?[!-\/:-@[-`{-~])[!-~]+\z/i'
        ],
        [
            'email.required' => 'メールアドレスは必須です。',
            'password.required' => 'パスワードは必須です。',
            'password.user' => 'メールアドレスが間違っています。',
            'password.min' => 'パスワードは6字以上255字以下で入力してください。',
            'password.confirmed' => 'パスワードが一致しません。',
            'password.regex' => '半角英数字記号それぞれ一文字以上使用してください',
        ]);
        

        $status = Password::reset(
            $request->only('email','password','password_confirmation','token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();
                event(new PasswordReset($user));
            }
        );
        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }

}
