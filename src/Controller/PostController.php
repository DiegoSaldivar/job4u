<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends Controller
{
    /**
     * @Route("/admin/bo/posts/list",name="list_posts")
     */
    public function listOfPosts() {
        
        return $this->render('posts/postlist.html.twig');
    }
   
}

