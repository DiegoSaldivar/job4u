<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Form\UserFormType;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    /**
     * @Route("/",name="login")
     */
    public function login(){
        return $this->render('login.html.twig');
    }
    
    /**
     * @Route("/userdash",name="userdash")
     */
    public function userdash(){
        return $this->render('userdash.html.twig');
    }
    
    /**
     * @Route("/register",name="register")
     */
    public function register(Request $request){
        $user=new User();
        
        $userForm=$this->createForm(UserFormType::class,$user,['standalone'=>true]);
        
        $userForm->handleRequest($request);
        if($userForm->isSubmitted()&&$userForm->isValid()) {
            $user->setVerified(false);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('login');
        }
       
        
        return $this->render('register.html.twig',['userForm'=>$userForm->createView()]);
    }
    
    /**
     * @Route("/admin/bo/user/create",name="create_user")
     */
    public function createUser(){
        return $this->render('base.html.twig');
    }
    
    /**
     * @Route("/admin/bo/user/list",name="list_user")
     */
    public function listUsers(){
        return $this->render('base.html.twig');
    }
}

