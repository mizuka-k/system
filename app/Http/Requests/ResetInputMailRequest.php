<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetInputMailRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required','email:rfc,dns,filter', 'exists:user,email']
        ];
    }

    /**
     * エラーメッセージ
     * @return array
     */
    public function message()
    {
        return [
            'email.required' => "メールアドレスを入力してください",
            'email.email' => "メールアドレスの形式ではありません",
            'mail.exists' => "登録しているメールアドレスを入力してください"
        ];
    }
}
