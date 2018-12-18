<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * Entity User
 * 
 * 
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
     * id of the User
     * 
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="guid")
     * 
     * @var string
     */
    private $id;

    /**
     * Username of the User
     * 
     * @ORM\Column(type="string", length=50)
     * @Assert\Length(min="8", minMessage="Your Username must be minium 8 characters")
     * @Assert\NotBlank()
     * @var string
     */
    private $username;

    /**
     * Hashed Password of the User
     * 
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min="8", minMessage="Your password must be minium 8 characters")
     * @Assert\NotBlank()
     * @var string
     */
    private $password;
    
    /**
     * The full name of the User 
     * 
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank()
     * @var string
     */
    private $Fullname;

    /**
     * The E-mail of the User that is needed for login and verification
     * 
     * @ORM\Column(type="string", length=50)
     * @Assert\Email()
     * @Assert\NotBlank()
     * @var string
     */
    private $email;

    /**
     * The verification Flag
     * 
     * @ORM\Column(type="boolean")
     * @var bool
     */
    private $verified;
    
    /**
     * An ArrayColection of roles
     * 
     * @ORM\Column(type="array")
     * @var ArrayCollection
     */
    private $roles;

    /**
     * Generated Salt for password hashing
     * 
     * @var string
     */
    private $salt;
    
    /**
     * Lanuages that the user speak
     * 
     * Many User knows one or Many languages.
     * @ORM\ManyToMany(targetEntity="Language")
     * @ORM\JoinTable(name="users_language",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="language_id", referencedColumnName="id")}
     *      )
     */
    private $languages;
    
    /**
     * Users that are following current user
     * 
     * Many Users have Many following Users.
     * @ORM\ManyToMany(targetEntity="User", mappedBy="following")
     */
    private $beFollowed;
    
    /**
     * Other users that are followed by current user
     * 
     * Many Users are following many Users.
     * @ORM\ManyToMany(targetEntity="User", inversedBy="beFollowed")
     * @ORM\JoinTable(name="follower",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="follower_user_id", referencedColumnName="id")}
     *      )
     */
    private $following;
    
    
    /**
     * Initialize specified variables on creation
     * 
     */
    public function __construct()
    {
        $this->languages = new \Doctrine\Common\Collections\ArrayCollection();
        $this->friendsWithMe = new \Doctrine\Common\Collections\ArrayCollection();
        $this->myFriends = new \Doctrine\Common\Collections\ArrayCollection();
        $this->roles=new ArrayCollection();
    }
    

    /**
     * Returns the id of the user
     * 
     * @return string|NULL id of the user
     */
    public function getId(): ?string
    {
        return $this->id;
    }
    
    
    /**
     * Returns the username of the User
     * {@inheritDoc}
     * @see \Symfony\Component\Security\Core\User\UserInterface::getUsername()
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * Set a new username of the user
     * 
     * @param string $username New username
     * @return User Returns the current user
     */
    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * 
     * {@inheritDoc}
     * @see \Symfony\Component\Security\Core\User\UserInterface::getPassword()
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * Sets new password for the user
     * 
     * @param string $password New hashed password
     * @return User Returns the current User
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Return the full name of the user
     * 
     * @return string|NULL Fullname
     */
    public function getFullname(): ?string
    {
        return $this->Fullname;
    }

    /**
     * Set a new full name for the user
     * 
     * @param string $Fullname The new Fullname
     * @return User Returns the current User
     */
    public function setFullname(string $Fullname): self
    {
        $this->Fullname = $Fullname;

        return $this;
    }

    /**
     * Returns the email used to authenticate the user
     * 
     * @return string|NULL E-mail Address of the user 
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Sets the email Address of the user
     * 
     * @param string $email New email address
     * @return User Returns the current User
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Returns the Status if the email is verified or not
     * 
     * @return bool True|False: is (not) Verified 
     * 
     */
    public function getVerified(): ?bool
    {
        return $this->verified;
    }

    /**
     * Sets the verification flag
     * 
     * @param bool $verified New flag status
     * @return User Returns the current User
     */
    public function setVerified(bool $verified): self
    {
        $this->verified = $verified;

        return $this;
    }
    
    public function eraseCredentials()
    {}

    /**
     * 
     * {@inheritDoc}
     * @see \Symfony\Component\Security\Core\User\UserInterface::getSalt()
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Sets the salt that is used to encode the password.
     * @param $salt
     */
    public function setSalt($salt){
        $this->salt=$salt;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Symfony\Component\Security\Core\User\UserInterface::getRoles()
     */
    public function getRoles()
    {
        $roles=[];
        foreach($this->roles as $role){
            $roles[]=$role->getLabel();
            
            return $roles;
        }
    }
    
    /**
     * Set the new roles granted to the user
     * 
     * @param ArrayCollection $roles
     */
    public function setRoles($roles) {
        foreach($roles as $role){
            $this->addRole($role);
        }
    }
    
    /**
     * Add a Role to the current Rolelist if the role is not contained in the role list
     * 
     * @param Role $role Role that is going to be added
     * @return User Returns the current User
     */
    public function addRole(Role $role) {
        if(!$this->roles->contains($role)){
            $this->roles->add($role);
        }
        
        return $this;
    }
    
    /**
     * Removes a role that is granted to the user
     * @param Role $role The removed role
     */
    public function removeRole(Role $role){
        if($this->roles->contains($role)){
            $this->roles->remove($role);
        }
    }

}
