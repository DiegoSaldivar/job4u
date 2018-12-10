<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class LanguageController extends Controller
{
    /**
     * @Route("/admin/bo/language/list",name="language_list")
     */
    public function listOfLanguages() {
        
        $this->render('base.html.twig');
    }
    
    /**
     * @Route("/admin/bo/language/create",name="language_create")
     */
    public function createLanguage(){
        
        $this->render('base.html.twig');
    }
}

