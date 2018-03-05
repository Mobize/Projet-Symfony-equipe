<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields="email", message="Cet email est déja utilisé")
 */
class User
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
    private $lastname;
    
    /**
     * @ORM\Column()
     * @Assert\NotBlank()
     * @var string
     */
    private $firstname;
    
     /**
     * @ORM\Column(unique=true)
     * @Assert\NotBlank()
     * @Assert\Email(message='Cet email n'est pas valide")
     * @var string
     */
    private $email;
    
    /**
     * @ORM\Column()
     * @var string
     */
    private $password;
    
    /**
     *@ORM\Column(length=20)
     * @var type 
     */
    private $role = 'ROLE_USER';
    
    /**
     *@Assert\NotBlank()
     * @var string 
     */
    private $plainPassword;
            
    
    function getId() {
        return $this->id;
    }

    function getLastname() {
        return $this->lastname;
    }

    function getFirstname() {
        return $this->firstname;
    }

    function getEmail() {
        return $this->email;
    }

    function getPassword() {
        return $this->password;
    }

    function getRole(): type {
        return $this->role;
    }

    function setLastname($lastname) {
        $this->lastname = $lastname;
    }

    function setFirstname($firstname) {
        $this->firstname = $firstname;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setRole(type $role) {
        $this->role = $role;
    }

    function getPlainPassword() {
        return $this->plainPassword;
    }

    function setPlainPassword($plainPassword) {
        $this->plainPassword = $plainPassword;
        return $this;
    }

}
