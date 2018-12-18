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
        if($this->content!=''){
            $ct= stream_get_contents($this->content);
            $target = urlencode($ct);
            
            if ((strpos($ct, 'http://') !== false)||(strpos($ct, 'https://') !== false)) {
                $key = "5c1385b510419135d8379e15248059a8664c375223e08";
                //https://api.linkpreview.net?key=5c1385b510419135d8379e15248059a8664c375223e08&q=https://www.youtube.com/watch?v=MDiRptzx-Vs
                
                $ret = file_get_contents("https://api.linkpreview.net?key={$key}&q={$target}");
                
                return json_decode($ret);
            }
            return $ct;
        }
    }

    /**
     * Set the content of the post
     * 
     * @param string $content
     * @return Post Returns the current post
     */
    public function setContent($content): self
    {
        $this->content =$content;

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
