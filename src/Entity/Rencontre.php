<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RencontreRepository")
 */
class Rencontre
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    // add your own fields
      /**
     *@ORM\Column(type="date")
     * @var \Datetime
     */
    private $date;
    
     /**
     * @ORM\ManyToOne(targetEntity="Equipe")
     * @ORM\JoinColumn(nullable=false)
     * @var Equipe 
     */
    private $equipe1;
     
     /**
     * @ORM\ManyToOne(targetEntity="Equipe")
     * @ORM\JoinColumn(nullable=false)
     * @var Equipe 
     */
    private $equipe2;  
    
     /**
     * @ORM\Column()
     * @Assert\NotBlank()
     * @var string 
     */
    private $lieu;     
    
    //SETTERS ET GETTERS
    
    public function getId() {
        return $this->id;
    }

    public function getDate(): ?\Datetime {
        return $this->date;
    }

    public function setDate(\Datetime $date) {
        $this->date = $date;
        return $this;
    }
    public function getEquipe1() {
        return $this->equipe1;
    }

    public function getEquipe2() {
        return $this->equipe2;
    }

    public function setEquipe1($equipe1) {
        $this->equipe1 = $equipe1;
        return $this;
    }

    public function setEquipe2($equipe2) {
        $this->equipe2 = $equipe2;
        return $this;
    }

    public function getLieu() {
        return $this->lieu;
    }

    public function setLieu($lieu) {
        $this->lieu = $lieu;
        return $this;
    }
}
