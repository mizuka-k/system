<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class EmailVerificationController extends Controller
{
    //確認メール送信画面
    public function index(Request $request)
    {
        return $request->user()->hasVerifiedEmail()
        ? redirect()->intended(RouteServiceProvider::HOME)
        : view('auth.verify-email');
    }

    // 確認メール送信
    public function notification(Request $request)
    {
        $user = $request->user();
        // メール認証済みの場合はホーム画面へ
        if($user->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME);
        }
        // メール送信
        $user->sendEmailVerificationNotification();
        return back()->with('successMessage','確認メールを送信しました。');
    }

    // メールリンクの検証
    public function verification(Request $request)
    {
        $user = $request->user();

        if($user->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
        }

        // email_verified_atカラムの更新
        if($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
    }
}
