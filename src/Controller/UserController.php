<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

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
    public function register(){
        return $this->render('register.html.twig');
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

