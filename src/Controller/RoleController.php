<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class RoleController extends Controller
{
    /**
     * @Route("/admin/bo/role/list",name="role_list")
     */
    public function listOfRole() {
        
        $this->render('base.html.twig');
    }
    
    /**
     * @Route("/admin/bo/role/create",name="role_create")
     */
    public function createRole(){
        
        $this->render('base.html.twig');
    }
}

