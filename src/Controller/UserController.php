<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;

class UserController extends Controller
{
    /**
     * @Route("/",name="login_entryPage")
     */
    public function login()
    {
        return $this->render('base.html.twig');
    }
    
    /**
     * @Route("/admin",name="admin_overview")
     */
    public function adminDashboard()
    {
        return $this->render('admin.html.twig');
    }
    
    
    /**
     * @Route("/admin/user/create",name="create_user")
     */
    public function createUser(Request $request){
       
        $user=new User();
        
        $userForm=$this->createFormBuilder($user)->getForm();
        
        $userForm->handleRequest($request);
        
        
        if($userForm->isSubmitted()&&$userForm->isValid()){
            return $this->redirectToRoute('list_users');
        }
        
        return $this->render('users/create.html.twig',['userForm'=>$userForm->createView()]);
    }
    
    /**
     * @Route("/admin/user/list",name="list_users")
     */
    public function listUsers(){
        
        $userList=$this->getDoctrine()
            ->getRepository(User::class)
            ->findAll();
        
        return $this->render('users/userlist.html.twig',['userList'=>$userList]);
    }
    
    

}

