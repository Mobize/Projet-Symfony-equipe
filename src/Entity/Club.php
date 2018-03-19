<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\ClubRepository;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Entity(repositoryClass="App\Repository\ClubRepository")
 * @UniqueEntity(fields="nom", message="il existe déjà un club de ce nom")
 */
class Club
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    
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
     *@ORM\Column(length=200, unique=true)
     * @var string 
     * 
     * Validation
     * @Assert\NotBlank(message="Le nom est oblgatoire")
     * @Assert\Length(max=20,maxMessage="Le nom ne doit pas dépasser {{ limit }} caractères")
     */

    private $nom;
    
     /**
     *@ORM\Column(length=4, type="string",nullable=true)
     * @var string 
     * 
     */
    private $anneeCreation;
    
    /**
     * @ORM\Column(length=15, type="string",nullable=true)
     * @var string 
     */
    private $sigle;
    
    /**
     * @ORM\Column(length=15, type="string",nullable=true)
     * @var string 
     */
    private $couleurs;
    
    /**
     * @ORM\Column(nullable=true)
     * @Assert\Image()
     * @var string 
     */
    private $logo;
    
    /**
     * @ORM\Column(length=255, type="string",nullable=true)
     * @var string 
     */
    private $stade;
    
    /**
     * @ORM\Column(length=255, type="string",nullable=true)
     * @var string 
     */
    private $statut;
    
    /**
     * @ORM\Column(length=70, type="string",nullable=true)
     * @var string 
     */
    private $president;
    
    /**
     * @ORM\Column(length=100, type="string",nullable=true)
     * @var string 
     */
    private $ville;
    
    /**
     * @ORM\Column(length=255, type="string",nullable=true)
     * @var string 
     */
    private $adresse;
    
    /**
     * @ORM\Column(length=40, type="string",nullable=true)
     * @var string 
     */
    private $email;
    
    /**
     * @ORM\Column(length=15, type="string",nullable=true)
     * @var string 
     */
    private $telephone;
    
     /**
     * @ORM\Column(unique=true)
     * @Assert\NotBlank(message="Ce champ ne doit pas etre vide")
     * @var string
     *
     */
    private $assoc;
    
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

    public function getAnneeCreation() {
        return $this->anneeCreation;
    }

    public function getSigle() {
        return $this->sigle;
    }

    public function getCouleurs() {
        return $this->couleurs;
    }

    public function getLogo() {
        return $this->logo;
    }

    public function getStade() {
        return $this->stade;
    }

    public function getStatut() {
        return $this->statut;
    }

    public function getPresident() {
        return $this->president;
    }

    public function getVille() {
        return $this->ville;
    }

    public function getAdresse() {
        return $this->adresse;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getTelephone() {
        return $this->telephone;
    }

    public function setNom($nom) {
        $this->nom = $nom;
        return $this;
    }

    public function setAnneeCreation($anneeCreation) {
        $this->anneeCreation = $anneeCreation;
        return $this;
    }

    public function setSigle($sigle) {
        $this->sigle = $sigle;
        return $this;
    }

    public function setCouleurs($couleurs) {
        $this->couleurs = $couleurs;
        return $this;
    }

    public function setLogo($logo) {
        $this->logo = $logo;
        return $this;
    }

    public function setStade($stade) {
        $this->stade = $stade;
        return $this;
    }

    public function setStatut($statut) {
        $this->statut = $statut;
        return $this;
    }

    public function setPresident($president) {
        $this->president = $president;
        return $this;
    }

    public function setVille($ville) {
        $this->ville = $ville;
        return $this;
    }

    public function setAdresse($adresse) {
        $this->adresse = $adresse;
        return $this;
    }

    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    public function setTelephone($telephone) {
        $this->telephone = $telephone;
        return $this;
    }

    public function __toString() 
    {
        return $this->nom;
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

    public function getClub(): ?Club {
        return $this->club;
    }

    public function setClub(Club $club) {
        $this->club = $club;
        return $this;
    }
    function setAssoc($assoc) {
        $this->assoc = $assoc;
    }
    
    function getAssoc() {
        return $this->assoc;
    }
    
}
