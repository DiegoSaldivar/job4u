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

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent()
    {
        if ($this->content != '')
        {
            return stream_get_contents($this->content);
        }
    }

    public function setContent($content): self
    {
        $this->content =$content;

        return $this;
    }
    /**
     * @return \DateTime
     */
    public function getCreatedAt():\DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt():self
    {
        $dt = new \DateTime();
        $this->createdAt = $dt;
        return $this;
    }
    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }
    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }



}
