<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\JoueurRepository")
 */
class Joueur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /** 
     * @var string
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    private $prenom;
    
    /** 
     * @var string
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    private $nom;
  
    /**
     * @var string
     * @ORM\Column(type="text")
     */
    private $rue;
    
    /**
     * @ORM\Column(length=5,type="string")
     * @var string
     * @Assert\NotBlank()
     */
    private $cp;
    
     /**
     * @var string
     * @ORM\Column(type="text")
     * Assert\NotBlank()
     */
    private $ville;
    
     /**
     * @ORM\Column(unique=true)
     * @Assert\NotBlank(message="Ce champ ne doit pas etre vide")
     * @Assert\Email(message="Cet email n'est pas valide")
     * @var string
     */
    private $mel;
    
    /**
     * @ORM\Column(length=10,type="string")
     * @var string
     * @Assert\NotBlank()
     */
    private $tel1;
    
    /**
    * @ORM\Column(length=10,type="string")
    * @var string
    */
    private $tel2;
    
    /**
     * @var date
     * @ORM\Column(type="date")
     * @Assert\NotBlank()
     */
    private $dateNaissance;
    
     /**
     * @var string
     * @ORM\Column(type="array")
     * @Assert\NotBlank()
     */
    private $genre;
    
     /**
     * @ORM\Column(nullable=true)
     * @Assert\Image()
     * @var string
     */
    private $image;
        
     /**
      * @ORM\Column(nullable=true)
     * @Assert\Image()
     * @var string
     */
    private $certificat;
    
    
    public static $genres = [
        'M',
        'F'
    ];



    public function getId() {
        return $this->id;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getRue() {
        return $this->rue;
    }

    public function getCp() {
        return $this->cp;
    }

    public function getVille() {
        return $this->ville;
    }

    public function getTel1() {
        return $this->tel1;
    }

    public function getTel2() {
        return $this->tel2;
    }

    public function getDateNaissance() {
        return $this->dateNaissance;
    }

    public function setPrenom($prenom) {
        $this->prenom = $prenom;
        return $this;
    }

    public function setNom($nom) {
        $this->nom = $nom;
        return $this;
    }

    public function setRue($rue) {
        $this->rue = $rue;
        return $this;
    }

    public function setCp($cp) {
        $this->cp = $cp;
        return $this;
    }

    public function setVille($ville) {
        $this->ville = $ville;
        return $this;
    }

    public function setTel1($tel1) {
        $this->tel1 = $tel1;
        return $this;
    }

    public function setTel2($tel2) {
        $this->tel2 = $tel2;
        return $this;
    }

    public function setDateNaissance($dateNaissance) {
        $this->dateNaissance = $dateNaissance;
        return $this;
    }

    public function getMel() {
        return $this->mel;
    }

    public function getImage() {
        return $this->image;
    }

    public function setMel($mel) {
        $this->mel = $mel;
        return $this;
    }

    public function setImage($image) {
        $this->image = $image;
        return $this;
    }

    public function getGenre() {
        return $this->genre;
    }

    public function setGenre($genre) {
        if (!in_array($genre, self::$genres)) {
            throw new \InvalidArgumentException('Genre non accepté');
        }
        
        $this->genre = $genre;
        return $this;
    }

 
    public function getCertificat() {
        return $this->certificat;
    }

    public function setCertificat($certificat) {
        $this->certificat = $certificat;
        return $this;
    }

  
}
