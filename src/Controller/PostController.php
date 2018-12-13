<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/admin/user/delete/{id}",name="del_user")
     */
    public function delete($id,Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->find($id);
        
        if (!$user) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
                );
        }
        
        $entityManager->remove($user);
        $entityManager->flush();
        
        return $this->redirectToRoute('list_users');
    }
   
}

