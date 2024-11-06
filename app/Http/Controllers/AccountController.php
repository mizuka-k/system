<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse; 
use App\Models\User;
use \Illuminate\Support\Facades\Auth; 
use App\Http\Requests\AccountRequest;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    //会員登録画面表示
    public function register() {
        return view('account.register');
    }

    // 会員登録処理
    public function store(AccountRequest $request) {
        $validated = $request->all();
        $user = User::create($validated);

        return redirect()->route('login')->with('successMessage','登録が完了しました。ログインしてください。');
    }

    // ログイン画面表示
    public function showLogin() {
        return view('account.login');
    }
    /**
     * ログイン処理
     * 
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *  */ 
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ],
        [
            'email.required' => 'メールアドレスは必須です。',
            'email.email' => '有効なメールアドレスではありません。',
            'password.required' => 'パスワードは必須です。',
            'password.min' => 'パスワードは6文字以上で入力してください。'
        ]);
        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $auth = Auth::user();
            return redirect()->route('home',compact('auth'))->with('successMessage','ログイン成功！');
        }
        return back()->with('alertMessage','メールアドレス、またはパスワードが違います。再度確認して入力してください。');

    }

    /**
     * ログアウト
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request) 
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('successMessage','ログアウトしました。');

    }

    // プロフィール表示
    public function profile() {
        $auth = Auth::user();
        return view('account.profile', compact('auth'));
    }
    // プロフィール編集画面表示
    public function showEdit(Request $request,$page) {
        $auth = Auth::user();
        $page = $request->page;
        return view('account.edit',compact('auth','page'));
    }
    // プロフィール編集
    public function profileUpdate(Request $request,$id) {
        // 選択ページ情報取得
        $page = $request->page;
        
        // 選択ページでバリデーションを選ぶ
        if($page == 'name') {
            $rule = User::$editNameRules;
            $message = User::$editNameRulesMessage;
        }elseif($page == 'email') {
            $rule = User::$editEmailRules;
            $message = User::$editEmailRulesMessage;
        }elseif($page == 'password') {
            // 現在のパスワードが正しいか確認する
            if(!(Hash::check($request->get('current_password'), Auth::user()->password))) {
                return back()->with('alertMessage','現在のパスワードが間違っています。');
            }
            $rule = User::$editPasswordRules;
            $message = User::$editPasswordRulesMessage;
        }
        // バリデーションチェック
        $validated = $request->validate($rule,$message);
        
        // アップデート
        Auth::user()->update($validated);

        $request->session()->flash('successMessage','更新しました。');
        return redirect()->route('profile',['$auth->id']);
    }


}
