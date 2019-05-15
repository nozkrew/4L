<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\SectionSite;
use AppBundle\Form\SectionSiteType;
use AdminBundle\Form\SiteAdminType;

/**
* @Route("/dashboard")
* @Template()
*/
class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction(Request $request)
    {
        
        $site = $this->getUser()->getSite();        
        
        $form = $this->createForm(SiteAdminType::class, $site);
        
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isSubmitted()){
            $em = $this->getDoctrine()->getManager();
            try{
                $em->flush();
                $this->get('session')->getFlashBag()->add('success', "Modification enregistrée");
                return $this->redirect($this->generateUrl("admin_default_index"));
            } catch (\Exception $ex) {
                $this->get('session')->getFlashBag()->add('error', "Une erreur est survenur. Veuillez rééssayer");
            }
            
        }
        
        return array(
            'site' => $site,
            'form' => $form->createView()
        );
    }
    
    /**
     * @Route("/post/{slug}", requirements={"slug"="le-4l-trophy|l-equipage"})
     * @param type $slug
     */
    public function postAction(Request $request, $slug){
        $sectionSite = $this->getSectionSiteRepository()->findBySectionAndSite($slug, $this->getUser()->getSite());
        
        
        if($sectionSite === null){
            //erreur post
            $this->get('session')->getFlashBag()->add('error', "Post introuvable");
            return $this->redirect($this->generateUrl('admin_default_index'));
        }
        
        if($sectionSite->getSection()->getType()->getName() !== "post"){
            //Erreur type
            $this->get('session')->getFlashBag()->add('error', "Post introuvable");
            return $this->redirect($this->generateUrl('admin_default_index'));
        }
        
                
        //formulaire edition section
        $form = $this->createForm(SectionSiteType::class, $sectionSite, array());
        
        $form->handleRequest($request);
        if($form->isValid() && $form->isSubmitted()){
            $em = $this->getDoctrine()->getManager();
            try{
                $em->flush();
                $this->get('session')->getFlashBag()->add('success', "Post enregistré");
                return $this->redirect($this->generateUrl("admin_default_post", array('slug'=>$slug)));
            } catch (\Exception $ex) {
                $this->get('session')->getFlashBag()->add('error', "Une erreur est survenue. Veuillez rééssayer");
            }
            
        }
        
        
        return array(
            'sectionSite' => $sectionSite,
            'form' => $form->createView()
        );
    }
    
    
    private function getSectionSiteRepository(){
        return $this->getDoctrine()->getRepository(SectionSite::class);
    }
    
}
