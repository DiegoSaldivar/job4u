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
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;



class UserController extends Controller
{
    /**
     * @Route("/",name="login")
     */
    public function login(AuthenticationUtils $authenticationUtils){
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        
        return $this->render('login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }
    
    /**
     * @Route("/userdash",name="userdash")
     */
    public function userdash(){
        return $this->render('userdash.html.twig');
    }
    
    /**
     * @Route("/userposts",name="userposts")
     */
    public function userposts(){
        return $this->render('userposts.html.twig');
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

