<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LanguageRepository")
 */
class Language
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
     * Returns the id of the language
     * 
     * @return string|NULL
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Changes the name of the language
     * 
     * @return string|NULL label
     */
    public function getLabel(): ?string
    {
        return $this->label;
    }

    /**
     * Changes the name of the language
     * @param string $label New Name
     * @return Language Returns Current language 
     */
    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }
}
