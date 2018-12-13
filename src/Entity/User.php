<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(
 *  fields= {"email"},
 *  message= "The email you have indicated is already used!"
 *  
 * )
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="guid")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min="8", minMessage="Your Username must be minium 8 characters")
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=128)
     * @Assert\Length(min="8", minMessage="Your password must be minium 8 characters")
     * 
     */
    private $password;
    
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Fullname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="boolean")
     */
    private $verified;
    
    /*
     * @ORM\ManyToOne(targetEntity="App\Entity\Role", inversedBy="User")
     *private $role;
     */
    
    
    /**
     * Many User knows one or Many languages.
     * @ORM\ManyToMany(targetEntity="Language")
     * @ORM\JoinTable(name="users_language",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="language_id", referencedColumnName="id")}
     *      )
     */
    private $languages;
    
    /**
     * Many Users have Many following Users.
     * @ORM\ManyToMany(targetEntity="User", mappedBy="following")
     */
    private $beFollowed;
    
    /**
     * Many Users are following many Users.
     * @ORM\ManyToMany(targetEntity="User", inversedBy="beFollowed")
     * @ORM\JoinTable(name="follower",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="follower_user_id", referencedColumnName="id")}
     *      )
     */
    private $following;
    
    
    public function __construct()
    {
        $this->languages = new \Doctrine\Common\Collections\ArrayCollection();
        $this->friendsWithMe = new \Doctrine\Common\Collections\ArrayCollection();
        $this->myFriends = new \Doctrine\Common\Collections\ArrayCollection();
    }
    

    public function getId(): ?string
    {
        return $this->id;
    }
/* 
    
    public function getRole():?Role
    {
        return $this->role;
    }
    
    public function setRole(Role $role):self
    {
        $this->role=$role;
        return $this;
    }
     */
    
    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getFullname(): ?string
    {
        return $this->Fullname;
    }

    public function setFullname(string $Fullname): self
    {
        $this->Fullname = $Fullname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getVerified(): ?bool
    {
        return $this->verified;
    }

    public function setVerified(bool $verified): self
    {
        $this->verified = $verified;

        return $this;
    }
    
    public function eraseCredentials() {}
    
    public function getSalt() {}
    
    public function getRoles(){
        return ['ROLE_USER'];
    }
    
    
}
