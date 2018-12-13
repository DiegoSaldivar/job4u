<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Role;
use App\Form\RoleFormType;
use Symfony\Component\HttpFoundation\Request;

class RoleController extends Controller
{
    /**
     * @Route("/admin/role/list",name="list_roles")
     */
    public function listOfRole() {
        
        $roleList=$this->getDoctrine()->getManager()->getRepository(Role::class)->findAll();
        
        return $this->render('roles/rolelist.html.twig',['roleList'=>$roleList]);
    }
    
    /**
     * @Route("/admin/role/create",name="create_role")
     */
    public function createRole(Request $request){
        $role=new Role();
        
 
        
        $roleForm=$this->createForm(RoleFormType::class,$role,['standalone'=>true]);
        
        
        $roleForm->handleRequest($request);
        
        
        
        if($roleForm->isSubmitted()&&$roleForm->isValid()){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($role);
            $entityManager->flush();
            return $this->redirectToRoute('list_roles');
        }
        
        return $this->render('roles/create.html.twig',['roleForm'=>$roleForm->createView()]);
    }
    
    
    /**
     * @Route("/admin/role/modify/{id}",name="mod_role")
     */
    public function update($id,Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $role = $entityManager->getRepository(Role::class)->find($id);
        
        if (!$role) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
                );
        }
        
        
        $roleForm=$this->createForm(RoleFormType::class,$role,['standalone'=>true]);
        
        $roleForm->handleRequest($request);
        
        
        
        if($roleForm->isSubmitted()&&$roleForm->isValid()){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($role);
            $entityManager->flush();
            return $this->redirectToRoute('list_roles');
        }
        
        return $this->render('roles/modify.html.twig',
            [
                'roleForm'=>$roleForm->createView()
            ]
            );
        
    }
    
    
    /**
     * @Route("/admin/role/delete/{id}",name="del_role")
     */
    public function delete($id,Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $role = $entityManager->getRepository(Role::class)->find($id);
        
        if (!$role) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
                );
        }
        
        $entityManager->remove($role);
        $entityManager->flush();
        
        return $this->redirectToRoute('list_roles');
    }
    
}

