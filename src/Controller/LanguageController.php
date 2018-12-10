<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class LanguageController extends Controller
{
    /**
     * @Route("/admin/language/list",name="list_languages")
     */
    public function listOfLanguages() {
        
        return $this->render('languages/languagelist.html.twig');
    }
    
    /**
     * @Route("/admin/language/create",name="language_create")
     */
    public function createLanguage(){
        
        return $this->render('base.html.twig');
    }
}

