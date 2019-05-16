<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Partner;
use AppBundle\Form\PartnerType;
use Symfony\Component\HttpFoundation\Request;


/**
* @Route("/dashboard/nos-partenaires")
* @Template()
*/
class PartnerController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction(){
        $partenaires = $this->getPartnerRepository()->findBySite($this->getUser()->getSite());
        
        return array(
            'partenaires' => $partenaires
        );
    }

    /**
     * @Route("/add")
     * @Route("/{id}/edit", requirements={"id"="\d+"})
     */
    public function editAction(Request $request, $id = null){
        
        if($id === null){
            $partenaire = new Partner();
        }
        else{
            $partenaire = $this->getPartnerRepository()->findOneById($id);
        
            if($partenaire === null){
                //erreur
                $this->get('session')->getFlashBag()->add('error', "Partenaire introuvable");
                return $this->redirect($this->generateUrl('admin_partner_index'));
            }

            if($partenaire->getSite() !== $this->getUser()->getSite()){
                //erreur 
                $this->get('session')->getFlashBag()->add('error', "Partenaire introuvable");
                return $this->redirect($this->generateUrl('admin_partner_index'));
            }
        }
        
        $form = $this->createForm(PartnerType::class, $partenaire, array(
            'site' => $this->getUser()->getSite()
        ));        
        
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            
            try{
                
                $partenaire->setSite($this->getUser()->getSite());
                
                $em = $this->getDoctrine()->getManager();
                if($partenaire->getId() === null){
                    $em->persist($partenaire);
                }
                $em->flush();
                
                $this->get('session')->getFlashBag()->add('success', "Partenaire enregistré");
                return $this->redirect($this->generateUrl("admin_partner_index"));
                
            } catch (\Exception $ex) {
                $this->get('session')->getFlashBag()->add('error', "Une erreur est survenue. Veuillez rééssayer");
            }
            
        }
        
        return array(
            'form' => $form->createView(),
            'partenaire' => $partenaire
        );
    }
    
    /**
     * @Route("/{id}/delete", requirements={"id"="\d+"})
     */
    public function deleteAction(Request $request, $id){
        
        $partenaire = $this->getPartnerRepository()->findOneById($id);

        if($partenaire === null){
            //erreur
            $this->get('session')->getFlashBag()->add('error', "Partenaire introuvable");
            return $this->redirect($this->generateUrl('admin_partner_index'));
        }

        if($partenaire->getSite() !== $this->getUser()->getSite()){
            //erreur 
            $this->get('session')->getFlashBag()->add('error', "Partenaire introuvable");
            return $this->redirect($this->generateUrl('admin_partner_index'));
        }
        
        $form = $this->createFormBuilder()->getForm();
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            
            try{
                $em = $this->getDoctrine()->getManager();
                $em->remove($partenaire);
                $em->flush();
                
                $this->get('session')->getFlashBag()->add('success', "Article enregistré");
                return $this->redirect($this->generateUrl("admin_partner_index"));
                
            } catch (\Exception $ex) {
                $this->get('session')->getFlashBag()->add('error', "Une erreur est survenue. Veuillez rééssayer");
            }
        }
        
        return array(
            'form' => $form->createView(),
            'partenaire' => $partenaire
        );
    }
    
    
    private function getPartnerRepository(){
        return $this->getDoctrine()->getRepository(Partner::class);
    }
}
