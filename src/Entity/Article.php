<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 */
class Article
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     * @ORM\Column()
     * @Assert\NotBlank()
     * @var string 
     */
    private $title;
    
    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     * @var string 
     */
    private $content;
    
    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     * @var string 
     */
    private $description;
    
    /**
     * @ORM\ManyToOne(targetEntity="Category")
     * @Assert\NotBlank()
     * @ORM\JoinColumn(nullable=false)
     * @var Category 
     */
    private $category;
    
      /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(nullable=false)
     * @var User 
     */
    private $author;
    
    function getId() {
        return $this->id;
    }

    function getTitle() {
        return $this->title;
    }

    function getContent() {
        return $this->content;
    }

    function getDescription() {
        return $this->description;
    }

    function getCategory() {
        return $this->category;
    }

    function getAuthor(): User {
        return $this->author;
    }

    function setTitle($title) {
        $this->title = $title;
    }

    function setContent($content) {
        $this->content = $content;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function setCategory(Category $category) {
        $this->category = $category;
    }

    function setAuthor(User $author) {
        $this->author = $author;
    }

    
}
