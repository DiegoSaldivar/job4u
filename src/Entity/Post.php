<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostRepository")
 */
class Post
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
    private $title;

    /**
     * @ORM\Column(type="blob")
     */
    private $content;
    
    
    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;
    
    
    /**
     * 
     * @ORM\Column(type="string", length=255)
     */
    private $category;
    
    
    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    
    /**
     * Returns the id of the post
     * 
     * @return string|NULL id
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Returns the title of the post
     * 
     * @return string|NULL title
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * Sets the title of the post
     * 
     * @param string $title New title
     * @return Post Returns the current post
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Returns the message written by the user
     * 
     * @return string content
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the content of the post
     * 
     * @param string $content
     * @return Post Returns the current post
     */
    public function setContent($content): self
    {
        $this->content = $content;

        return $this;
    }
    
    
    /**
     * Returns the date and time where the post was created
     * 
     * @return \DateTime date and time of the post
     */
    public function getCreatedAt():\DateTime
    {
        return $this->createdAt;
    }

    /**
     * Set the current time as the time and date where the post was created
     * 
     */
    public function setCreatedAt():self
    {
        $dt = new \DateTime();
        $this->createdAt = $dt->format('H:i:s d-m-Y');
        return $this;
    }

}
