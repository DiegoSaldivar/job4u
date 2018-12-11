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
    
    /**
     * @Route("/admin/language/modify/{id}",name="mod_lang")
     */
    public function update($id,Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $lang = $entityManager->getRepository(Language::class)->find($id);
        
        if (!$lang) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
                );
        }
        
        
        $langForm=$this->createForm(LanguageFormType::class,$lang,['standalone'=>true]);
        
        $langForm->handleRequest($request);
        
        
        
        if($langForm->isSubmitted()&&$langForm->isValid()){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($lang);
            $entityManager->flush();
            return $this->redirectToRoute('list_languages');
        }
        
        return $this->render('languages/modify.html.twig',
            [
                'langForm'=>$langForm->createView()
            ]
            );
        
    }
    
    
    /**
     * @Route("/admin/language/delete/{id}",name="del_lang")
     */
    public function delete($id,Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $lang = $entityManager->getRepository(Language::class)->find($id);
        
        if (!$lang) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
                );
        }
        
        $entityManager->remove($lang);
        $entityManager->flush();
        
        return $this->redirectToRoute('list_languages');
    }
}

