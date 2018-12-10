<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Language;
use App\Form\LanguageFormType;
use Symfony\Component\HttpFoundation\Request;

class LanguageController extends Controller
{
    /**
     * @Route("/admin/language/list",name="list_languages")
     */
    public function listOfLanguages() {
        
        $langList=$this->getDoctrine()->getManager()->getRepository(Language::class)->findAll();
        
        return $this->render('languages/languagelist.html.twig',['langList'=>$langList]);
    }
    
    /**
     * @Route("/admin/language/create",name="language_create")
     */
    public function createLanguage(Request $request){
        $lang=new Language();
     
        $langForm=$this->createForm(LanguageFormType::class,$lang,['standalone'=>true]);
        
        
        $langForm->handleRequest($request);
        
        
        
        if($langForm->isSubmitted()&& $langForm->isValid()){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($lang);
            $entityManager->flush();
            return $this->redirectToRoute('list_languages');
        }
    
        return $this->render('languages/create.html.twig',['langForm'=>$langForm->createView()]);
    }
}

