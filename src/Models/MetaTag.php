<?php

namespace Models;

class MetaTag 
{
    /** @var string */
    private $title;
    
    /** @var string */
    private $keywords;
    
    /** @var string */
    private $description;

    public function __construct(string $title = '', string $keywords = '', string $description = '')
    {
        $this->title = $title;
        $this->keywords = $keywords;
        $this->description = $description;
    }

    public function setTitle($title) 
    {
        $this->title = $title;
    }

    public function setKeywords($keywords) 
    {
        $this->keywords = $keywords;
    }

    public function setDescription($description) 
    {
        $this->description = $description;
    }

    public function getTitle() 
    {
        return $this->title;
    }

    public function getKeywords() 
    {
        return $this->keywords;
    }

    public function getDescription() 
    {
        return $this->description;
    }

}
