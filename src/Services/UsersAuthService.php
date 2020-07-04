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
        $_SESSION['id'] = $user->getId();
        $_SESSION['agent'] = $_SERVER['HTTP_USER_AGENT'];
        $token = $user->getAuthToken();
        setcookie('kts', $token, 0, '/', '', false, true);
    }
    
    /**
     * @return User|null
     */
    public static function getUserByToken(): ?User 
    {
        if (!isset($_SESSION['id']) && !isset($_SESSION['agent']) &&
        !isset($_COOKIE['kts'])) {
           return null;
        }
        
        if ($_SESSION['agent'] !== $_SERVER['HTTP_USER_AGENT']) { 
            self::tokenReset();
            return null;
        }
        
        $token = $_COOKIE['kts'];
        
        if (empty($token)) {
            self::tokenReset();
            return null;
        }

        $authToken = Helper::sanitizeString($token);
        
        $id = $_SESSION['id'];

        $user = User::getById($id);
        
        if ($user === null) {
            return null;
        }
        
        if ($user->getAuthToken() !== $authToken) {
            self::tokenReset();
            return null;
        }
        
        return $user;
    }
    
    /**
     * @return void
     */
    public static function tokenReset(): void 
    {
        session_regenerate_id();
        unset($_SESSION['id']);
        unset($_SESSION['agent']);
        setcookie('kts', '', 0, '/', '', false, true);
    }

}
