<?php

namespace Services;

use Models\Users\User;
use helpers\Helper;

class UsersAuthService 
{
    
    public static function createToken(User $user): void
    {
        $token = $user->getId() . ':' . $user->getAuthToken();
        setcookie('token', $token, 0, '/', '', false, true);
    }

    public static function getUserByToken(): ?User
    {
        $token = $_COOKIE['token'] ?? '';

        if (empty($token)) {
            return null;
        }

        [$userId, $authToken] = explode(':', $token, 2);

        $user = User::getById((int) $userId);

        if ($user === null) {
            return null;
        }

        if ($user->getAuthToken() !== $authToken) {
            return null;
        }

        return $user;
    }
    
    /**
     * @return void
     */
    public static function tokenReset(): void 
    {
        setcookie('token', '', 0, '/', '', false, true);
    }
}
