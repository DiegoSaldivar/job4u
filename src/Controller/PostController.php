<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Post;

class PostController extends Controller
{
    /**
     * @Route("/admin/posts/list",name="list_posts")
     */
    public function listOfPosts() {
        
        $postList=$this->getDoctrine()
        ->getRepository(Post::class)
        ->findAll();
        
        return $this->render('posts/postlist.html.twig',['postList'=>$postList]);
    }
   
}

