<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // 管理者ユーザー
        Gate::define('admin', function (User $user) {
            return ($user->role === 1);
        });

        // 一般ユーザー
        Gate::define('general', function (User $user) {
            return ($user->role === 0);
        });

        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return (new MailMessage)
                ->subject('メールアドレスの確認')
                ->action('確認', $url)
                ->view('emails.verify-email');
        });
    }
}
