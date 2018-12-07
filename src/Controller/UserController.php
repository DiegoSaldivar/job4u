<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends Controller
{
    /**
     * @Route("/",name="login_entryPage")
     */
    public function login(){
        return $this->render('base.html.twig');
    }
}

