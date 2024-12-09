<?php

namespace App\Repositories\Interfaces;

use App\Models\User;

interface UseRepositoryInterface
{
    /**
     * メールアドレスからユーザー情報を取得
     * 
     * @param string $email
     * @return User
     */
    public function findFromMail(string $email): User;

    /**
     * パスワードリセット用トークンを発行
     * 
     * @param int $userId
     * @return User
     */
    public function update0rCreateUser(int $userId): User;
}