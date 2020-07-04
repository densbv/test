<?php

namespace Controllers;

use Models\Users\User;
use Services\UsersAuthService;
use View\View;
use Models\MetaTag;

abstract class AbstractController 
{
     /** @var View */
    protected $view;

    /** @var User|null */
    protected $user;
    
    protected $metaTag;

    public function __construct()
    {
        $this->user = UsersAuthService::getUserByToken();
        $this->view = new View(__DIR__ . '/../../templates');
        $this->view->setVar('user', $this->user);
        $this->metaTag = new MetaTag();
    }
}
