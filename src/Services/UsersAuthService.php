<?php

namespace Services;

use Models\Users\User;
use helpers\Helper;

class UsersAuthService 
{
    /**
     * @param User $user
     * @return void
     */
    public static function createToken(User $user): void 
    {
        session_regenerate_id();

        $_SESSION['agent'] = $_SERVER['HTTP_USER_AGENT'];
        
        //$token = $user->getId() . ':' . $user->getAuthToken();
        $token = $user->getAuthToken();
        setcookie('kts', $token, 0, '/', '', false, true);
    }
    
    /**
     * @return User|null
     */
    public static function getUserByToken(): ?User 
    {
        if ($_SESSION['agent'] !== $_SERVER['HTTP_USER_AGENT']) {
            setcookie('kts', '', 0, '/', '', false, true);
            unset($_SESSION['agent']);
            return null;
        }
        
        $token = $_COOKIE['kts'];
        
        if (empty($token)) {
            return null;
        }

        $authToken = Helper::sanitizeString($token);

        $user = User::findOneByColumn('auth_token', $authToken);
        
        if ($user === null) {
            return null;
        }
        
        return $user;
        
        //[$userId, $authToken] = explode(':', $token, 2);
        //$user = User::getById((int) $userId);
    }
}
