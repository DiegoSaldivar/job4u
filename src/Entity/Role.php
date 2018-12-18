<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Entity Role
 * 
 * @ORM\Entity(repositoryClass="App\Repository\RoleRepository")
 */
class Role 
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="guid")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $label;
 
    
    /**
     * Return the id of the Role
     * 
     * @return string|NULL id of the Role
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Returns the label of the Role
     * 
     * @return string|NULL label of the role
     */
    public function getLabel(): ?string
    {
        return $this->label;
    }

    /**
     * Sets a new label for the role
     * 
     * @param string $label new label
     * @return Role of current Role
     */
    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }
    
    
    /**
     * Returns the label when only Role itself is given to a string
     * 
     * @return string Label of the Role
     */
    public function __toString()
    {
        return $this->getLabel();
    }
   
}
