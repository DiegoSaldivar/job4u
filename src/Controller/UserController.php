<?php
namespace App\Controller;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Role;
use App\Entity\User;
use App\Form\UserFormType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;



class UserController extends Controller
{
    
    /**
     * @Route("/userdash",name="userdash")
     */
    public function userdash(){
        return $this->render('userdash.html.twig');
    }
    
    /**
     * @Route("/register",name="register")
     */
    public function register(Request $request, 
        UserPasswordEncoderInterface $encoder){
        
        $user=new User();
        
        $userForm=$this->createForm(UserFormType::class,$user,['standalone'=>true]);
        
        $userForm->handleRequest($request);
        
        if($userForm->isSubmitted()&&$userForm->isValid()) {
            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);
            
            $user->setVerified(false);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('login');
        }
       
        
        return $this->render('register.html.twig',['userForm'=>$userForm->createView()]);

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
        
        $options=['standalone'=>true];

        $userForm=$this->createForm(UserFormType::class,$user);
        
        
        $userForm->add('role',EntityType::class,array(
            'class'=>Role::class,
            'choice_label'=>'Role'
            )
        );
        
        if ($options['standalone'])
        {
            $userForm->add('submit', SubmitType::class);
        }
        
        $userForm->handleRequest($request);
        
        
        
        if($userForm->isSubmitted()&&$userForm->isValid()){
            $user->setVerified(true);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
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

