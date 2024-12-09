<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse; 
use App\Models\User;
use \Illuminate\Support\Facades\Auth; 
use App\Http\Requests\AccountRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

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

        event(new Registered($user));
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
    public function showEdit(Request $request) {
        $auth = Auth::user();
        return view('account.edit',compact('auth'));
    }
// プロフィール編集
public function profileUpdate(Request $request, User $user) {
    $user = Auth::user();
    //バリデーションチェック
    $validated = $request->validate([
        'name' => 'required|string|max:100',
        'email' => 'required|email|unique:users,email,'.Auth::user()->email.',email',
        'password' => (Auth::user()->password) ? 'string|min:6|confirmed|nullable' : 'required|min:6|confirmed',
    ],
    [
        'name.required' => '名前は必須です。',
        'name.max' => '名前は100文字以下で入力してください。',
        'email.required' => 'メールアドレスは必須です。',
        'email' => '有効なメールアドレスではありません。',
        'email.unique' => 'このメールアドレスはすでに使用されています。',
        'password.min' => 'パスワードは6字以上255字以下で入力してください。',
        'password.confirmed' => '入力したパスワードがパスワード（確認）と一致しません。'
    ]);
    // パスワードの値に入力があれば
    if ($validated['password']) {
        // 現在のパスワードが合っているか確認
        if(!(Hash::check($request->get('current_password'), Auth::user()->password))) {
            return back()->with('alertMessage','現在のパスワードが間違っています。');
        }
        // パスワードハッシュ化
        $validated['password'] = Hash::make($validated['password']);
        
    } else {
        // 値が無ければパラメータに含めない
        unset($validated['password']);
    }
    // dd($validated);
    // アップデート
    $user->update($validated);
    $request->session()->flash('successMessage','更新しました。');
    return redirect()->route('profile','$user->id');
}

}
