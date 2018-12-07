<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends Controller
{
    /**
     * @Route("/admin/bo/posts/list",name="post_list")
     */
    public function listOfPosts() {
        
        $this->render('base.html.twig');
    }
   
}

