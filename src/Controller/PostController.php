<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Post;
use App\Form\PostFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PostController extends AbstractController
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
    
    /**
     * @Route("/admin/post/modify/{id}",name="mod_post")
     */
    public function update($id,Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $post = $entityManager->getRepository(Post::class)->find($id);
        
        if (!$post) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
                );
        }

        
        $postForm=$this->createForm(PostFormType::class,$post,['standalone'=>true]);

        $postForm->handleRequest($request);
        
        
        
        if($postForm->isSubmitted()&&$postForm->isValid()){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($post);
            $entityManager->flush();
            return $this->redirectToRoute('list_posts');
        }
        
        return $this->render('users/modify.html.twig',
            [
                'postForm'=>$postForm->createView()
            ]
        );
        
    }
    
    
    /**
     * @Route("/admin/user/delete/{id}",name="del_post")
     */
    public function delete($id,Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $post = $entityManager->getRepository(Post::class)->find($id);
        
        if (!$post) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
                );
        }
        
        $entityManager->remove($post);
        $entityManager->flush();
        
        return $this->redirectToRoute('list_users');
    }
   
}

