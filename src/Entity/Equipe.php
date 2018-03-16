<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EquipeRepository")
 */
class Equipe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    // add your own fields
    
    //Date de création enregistrement
    /**
     * @ORM\Column(type="datetime",nullable=false)
     * * @var \Datetime
     */
    private $createdAt;

    //Date de modification enregistrement
    /**
     * @ORM\Column(type="datetime",nullable=true)
     * * @var \datetime
     */
    private $updatedAt;
    
     /**
     *@ORM\Column(length=20)
     * @var string 
     * 
     * Validation
     * @Assert\NotBlank(message="Le nom est oblgatoire")
     * @Assert\Length(max=20,maxMessage="Le nom ne doit pas dépasser {{ limit }} caractères")
     */
    private $nom;
    
     /**
     * @ORM\ManyToOne(targetEntity="Club",cascade={"persist"}, fetch="EAGER")
     * @ORM\JoinColumn(nullable=false)
     * @var Club 
     */
     private $club;
     
     /**
     * @ORM\Column(nullable=true)
     * @Assert\Image()
     * @var string 
     */
     private $image;

     /**
     * @ORM\Column(type="boolean",nullable=true)
     * * @var boolean   
     */
     private $local;
     
    //pour l'enregistrement automatique de la date de création de l'enregistrement
    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }
    
    //SETTERS ET GETTERS
    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function setNom($nom) {
        $this->nom = $nom;
        return $this;
    }

    function getCreatedAt() {
        return $this->createdAt;
    }

    function getUpdatedAt() {
        return $this->updatedAt;
    }

    function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;
    }

    function setUpdatedAt($updated_at) {
        $this->updatedAt = $updatedAt;
    } 
    
    public function __toString() 
    {
        return $this->nom;
    }

    public function getClub(): Club {
        return $this->club;
    }

    public function setClub(Club $club) {
        $this->club = $club;
        return $this;
    }

    public function getLocal() {
        return $this->local;
    }

    public function setLocal($local) {
        $this->local = $local;
        return $this;
    }

    function getImage() {
        return $this->image;
    }

    function setImage($image) {
        $this->image = $image;
    }
    
    
}
