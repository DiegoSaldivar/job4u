<?php
namespace App\Controller;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Role;
use App\Entity\User;
use App\Form\UserFormType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;





class UserController extends AbstractController
{
    
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
    public function register(Request $request,UserPasswordEncoderInterface $encoder,\Swift_Mailer $mailer){

        $user=new User();
        
        $userForm=$this->createForm(UserFormType::class,$user,['standalone'=>true]);
        
        $userForm->handleRequest($request);
        
        if($userForm->isSubmitted()&&$userForm->isValid()) {
           
            $hash=$encoder->encodePassword($user,$user->getPassword());
            $user->setPassword($hash);
            
            $user->setVerified(false);
            
            $message = (new \Swift_Message('Job4U Account Verification Email'))
            ->setFrom('lookingjob4u@gmail.com')
            ->setTo($user->getEmail())
            ->setBody(
                $this->renderView(
                    // templates/emails/registration.html.twig
                    'emails/registration.html.twig',
                    array(
                        'name' => $user->getUsername(),
                        'email' => $user->getEmail()      
                    )
                ),
                'text/html'
            );
            
            $mailer->send($message);
            
            
            $user->addRole(
              $this->getDoctrine()->getManager()->getRepository(Role::class)->findOneByLabel('ROLE_USER')  
            );
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            
            
            return $this->redirectToRoute('app_login');
        }
       
        
        return $this->render('register.html.twig',['userForm'=>$userForm->createView()]);

    }
    
    /**
     *  @Route("/user/verify/{email}",name="verify_reg")
     */
    public function verifyUser($email)
    {
        $user=$this->getDoctrine()->getManager()->getRepository(User::class)->findOneByEmail($email);      
        $user->setVerified(true);
        
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();
        
        return $this->redirectToRoute('app_login');
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
    public function createUser(Request $request,UserPasswordEncoderInterface $encoder){
       
        $user=new User();
        
        $options=['standalone'=>true];

        $userForm=$this->createForm(UserFormType::class,$user);
        
        $roles=$this->getDoctrine()->getManager()->getRepository(Role::class)->findAll();
        
        $roleLabels=[];
        
        foreach ($roles as $role){
            $roleLabels[$role->getLabel()]= $role;
        }
   
        
        if ($options['standalone'])
        {
            $userForm->add('submit', SubmitType::class);
        }
        
        $userForm->handleRequest($request);
        
        
        
        if($userForm->isSubmitted()&&$userForm->isValid()){
            $hash=$encoder->encodePassword($user,$user->getPassword());
            $user->setPassword($hash);
            
            $user->setVerified(true);
            $user->addRole(
                $this->getDoctrine()->getManager()->getRepository(Role::class)->findOneByLabel($request->request->get('roles'))
            );
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('list_users');
        }
        
        return $this->render('users/create.html.twig',
            [
                'userForm'=>$userForm->createView(),
                'roles'=>$roleLabels
            ]);
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
    
    /**
     * @Route("/admin/user/modify/{id}",name="mod_user")
     */
    public function update($id,Request $request,UserPasswordEncoderInterface $encoder)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->find($id);
        
        if (!$user) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
                );
        }
        
        
        $options=['standalone'=>true];
        
        $userForm=$this->createForm(UserFormType::class,$user);
        
        
        if ($options['standalone'])
        {
            $userForm->add('submit', SubmitType::class);
        }
        
        $userForm->handleRequest($request);
        
        
        
        if($userForm->isSubmitted()&&$userForm->isValid()){
            $hash=$encoder->encodePassword($user,$user->getPassword());
            $user->setPassword($hash);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('list_users');
        }
        
        return $this->render('users/modify.html.twig',
            [
                'userForm'=>$userForm->createView()
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

