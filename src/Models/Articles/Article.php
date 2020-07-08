<?php

namespace Models\Articles;

use Models\ActiveRecordEntity;
use Models\Users\User;
use Exceptions\InvalidArgumentException;

class Article extends ActiveRecordEntity
{

    /** @var string */
    protected $name;

    /** @var string */
    protected $text;

    /** @var int */
    protected $authorId;

    /** @var string */
    protected $createdAt;
    
    /**
     * @return int
     */
    public function getId(): int 
    {
        return $this->id;
    }
    
    /**
     * @return string
     */
    public function getName(): string 
    {
        return $this->name;
    }
    
    /**
     * @param string $name
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }
    
    /**
     * @return string
     */
    public function getText(): string 
    {
        return $this->text;
    }

    /**
     * @param string $text
     * @return void
     */
    public function setText(string $text): void 
    {
        $this->text = $text;
    }


    /**
     * @return int
     */
    public function getAuthor(): User 
    {
        return User::getById($this->authorId);
    }
    
    /**
     * @param User $author
     */
    public function setAuthor(User $author): void 
    {
        $this->authorId = $author->getId();
    }

    /**
     * @return string
     */
    protected static function getTableName(): string
    {
        return 'articles';
    }
    
    public static function createFromArray(array $fields, User $author): Article 
    {
        if (empty($fields['name'])) {
            throw new InvalidArgumentException('Не передано название статьи');
        }

        if (empty($fields['text'])) {
            throw new InvalidArgumentException('Не передан текст статьи');
        }
        
        $article = new Article();
        
        $article->setAuthor($author);
        $article->setName($fields['name']);
        $article->setText($fields['text']);
        
        $article->save();
        
        return $article;
    }
    
    public function updateFromArray(array $fields): Article
    {
    if (empty($fields['name'])) {
            throw new InvalidArgumentException('Не передано название статьи');
        }

        if (empty($fields['text'])) {
            throw new InvalidArgumentException('Не передан текст статьи');
        }

        $this->setName($fields['name']);
        $this->setText($fields['text']);

        $this->save();

        return $this;
    }
    
}
