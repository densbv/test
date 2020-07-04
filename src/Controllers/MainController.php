<?php

namespace Controllers;

use Models\Articles\Article;

class MainController extends AbstractController
{

    public function main()
    {

        var_dump($_SESSION);
        $articles = Article::findAll();
        
        $this->metaTag->setTitle('My BLOG');  
        
        $this->view->renderHtml('main/main.php', [
            'articles' => $articles,
            'metaTag' => $this->metaTag
                ]);
    }

}
