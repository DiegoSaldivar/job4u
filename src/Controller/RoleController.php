<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class RoleController extends Controller
{
    /**
     * @Route("/admin/bo/role/list",name="list_roles")
     */
    public function listOfRole() {
        
        return $this->render('roles/rolelist.html.twig');
    }
    
    /**
     * @Route("/admin/bo/role/create",name="role_create")
     */
    public function createRole(){
        
        return $this->render('base.html.twig');
    }
}

