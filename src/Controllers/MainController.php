<?php

namespace Controllers;

use Models\Articles\Article;

class MainController extends AbstractController
{

    public function main()
    {
        $articles = Article::findAll();
        
        $this->metaTag->setTitle('My Site');  
        
        $this->view->renderHtml('main/main.php', [
            'articles' => $articles,
            'metaTag' => $this->metaTag
                ]);
    }

}
