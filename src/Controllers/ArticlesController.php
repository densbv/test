<?php

namespace Controllers;

use Models\Articles\Article;
use Exceptions\NotFoundException;
use Exceptions\UnauthorizedException;
use Exceptions\InvalidArgumentException;

class ArticlesController extends AbstractController 
{

    public function view(int $articleId): void 
    {
        $article = Article::getById($articleId);

        if ($article === null) {
            throw new NotFoundException();
        }
        
        $this->metaTag->setTitle($article->getName());  
        $this->metaTag->setKeywords('новое, статья');
        $this->metaTag->setDescription($article->getName());

        $this->view->renderHtml('articles/view.php', [
            'article' => $article,
            'metaTag' => $this->metaTag
        ]);
    }

    public function edit(int $articleId): void 
    {
        $article = Article::getById($articleId);

        if ($article === null) {
            throw new NotFoundException();
        }
        
        if ($this->user === null) {
            throw new UnauthorizedException();
        }
        
        if ($this->user->getRole() !== 'admin') {
            throw new NotFoundException();
        }

        if (!empty($_POST)) {
            try {
                $article->updateFromArray($_POST);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('articles/edit.php', ['error' => $e->getMessage(), 'article' => $article]);
                return;
            }

            header('Location: /articles/' . $article->getId(), true, 302);
            exit();
        }
        
        $this->view->renderHtml('articles/edit.php', ['article' => $article]);
    }
    
    public function add(): void 
    {

        if ($this->user === null) {
            throw new UnauthorizedException();
        }
        
        if ($this->user->getRole() !== 'admin') {
            throw new NotFoundException();
        }
        
        if (!empty($_POST)) {
            try {
                $article = Article::createFromArray($_POST, $this->user);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('articles/add.php', ['error' => $e->getTraceAsString()]);
                return;
            }
            
            header('Location: /articles/' . $article->getId(), true, 302);
            exit();
        }
        
        $this->view->renderHtml('articles/add.php');
    }
    
    public function delete(int $articleId) 
    {
        if ($this->user->getRole() !== 'admin') {
            throw new NotFoundException();
        }
        
        $article = Article::getById($articleId);
        
        $article->delete();
        
        
    }

}
