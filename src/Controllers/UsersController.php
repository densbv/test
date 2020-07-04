<?php

namespace Controllers;

use Exceptions\InvalidArgumentException;
use Models\Users\UserActivationService;
use Services\EmailSender;
use Models\Users\User;
use Services\UsersAuthService;

class UsersController extends AbstractController
{

    public function signUp() 
    {
        if ($this->user === null) {
            if (!empty($_POST)) {
                try {
                    $user = User::signUp($_POST);
                } catch (InvalidArgumentException $e) {
                    $this->view->renderHtml('users/signUp.php', 
                            ['error' => $e->getMessage()]);
                    return;
                }

                if ($user instanceof User) {
                    $code = UserActivationService::createActivationCode($user);

                    EmailSender::send($user, 'Активация', 'userActivation.php', [
                        'userId' => $user->getId(),
                        'code' => $code
                    ]);

                    $this->view->renderHtml('users/signUpSuccessful.php');
                    return;
                }
            }

            $this->view->renderHtml('users/signUp.php');
        } else {
            header('Location: /');
        }
    }

    public function activate(int $userId, string $activationCode) 
    {
        $user = User::getById($userId);
        $isCodeValid = UserActivationService::checkActivationCode($user, 
                $activationCode);
        if ($isCodeValid) {
            $user->activate();
            echo 'OK!';
        }
    }
    
    public function login() 
    {
        if ($this->user === null) {
            if (!empty($_POST)) {
                try {
                    $user = User::login($_POST);
                    UsersAuthService::createToken($user);
                    header('Location: /');
                    exit();
                } catch (InvalidArgumentException $e) {
                    $this->view->renderHtml('users/login.php', 
                            ['error' => $e->getMessage()]);
                    return;
                }
            }
            $this->view->renderHtml('users/login.php');
        } else {
            header('Location: /');
        }
    }

    public function logout() 
    {
        if ($this->user !== null) {
            UsersAuthService::tokenReset();
        }
        header('Location: /');
    }

}
