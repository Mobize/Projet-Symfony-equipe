<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields="email", message="Cet email est déja utilisé")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column()
     * @Assert\NotBlank(message="Ce champ ne doit pas etre vide")
     * @var string
     */
    private $lastname;
    
    /**
     * @ORM\Column()
     * @Assert\NotBlank(message="Ce champ ne doit pas etre vide")
     * @var string
     */
    private $firstname;
    
     /**
     * @ORM\Column(unique=true)
     * @Assert\NotBlank(message="Ce champ ne doit pas etre vide")
     * @Assert\Email(message="Cet email n'est pas valide")
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
     *@Assert\NotBlank(message="Ce champ ne doit pas etre vide")
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

    function getRole() {
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

    function setRole($role) {
        $this->role = $role;
    }

    function getPlainPassword() {
        return $this->plainPassword;
    }

    function setPlainPassword($plainPassword) {
        $this->plainPassword = $plainPassword;
        return $this;
    }
    
    //redefini les droit d utilisateur si besoin
    public function eraseCredentials() 
    {
        
    }
    
    public function getRoles() 
    {
        return [$this->role];
    }
    
    //ajoute une securité au cryptage du mot de passe
    //dans notre cas il y est deja brace à bcrypt
    public function getSalt() 
    {
        
    }
    
    public function getUsername(): string {
        return $this->email;
    }
    
    //affiche le nom et prenom de l utilisateur si il est connecté
    public function getFullname()
    {
        return $this->firstname . ' ' . $this->lastname;
    }
    
    public function __toString() 
    {
        return $this->getFullname();
    }


}
