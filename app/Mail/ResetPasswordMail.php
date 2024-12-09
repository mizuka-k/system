<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use Carbon\Carbon;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    private $user;
    private $userToken;

    /**
     * Create a new message instance.
     * construct
     * 
     * @param User $user
     * @param User $userToken
     */
    public function __construct(User $user, User $userToken)
    {
        $this->user = $user;
        $this->userToken = $userToken;
    }

    public function build()
    {
        // トークン取得
        $tokenParam = ['reset_token' => $this->userToken->rest_password_access_key];
        $now = Cabon::now();

        // 署名付き有効期限24時間のURLを生成
        $url = URL::temporarySignedRoute('reset.password.edit', $now->addHours(24), $tokenParam);

        // HTML形式でメール作成
        return $this->view('emails.password_reset_mail')
                    ->subject('パスワード再設定用URLのご案内')
                    ->from(config('mail.form.address'), config('mail.from.name'))
                    ->to($this->user->mail)
                    ->with([
                        'user' => $this->user,
                        'url' => $url,
                    ]);
    }
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reset Password Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'view.name',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
