<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Contact;
use AppBundle\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;

/**
* @Route("/dashboard/contact")
* @Template()
*/
class ContactController extends Controller{
    /**
     * @Route("/")
     */
    public function indexAction(){        
        $contacts = $this->getContactRepository()->findBySite($this->getUser()->getSite());
        
        return array(
            'contacts' => $contacts
        );
    }
    
    /**
     * @Route("/add")
     * @Route("/{id}/edit", requirements={"id"="\d+"})
     */
    public function editAction(Request $request, $id = null){        
        if($id === null){
            
            $contacts = $this->getContactRepository()->findBySite($this->getUser()->getSite());

            //Nb max de contacts
            if(count($contacts) >= 3){
                $this->get('session')->getFlashBag()->add('error', "Vous ne pouvez pas ajouter plus de 3 contacts");
                return $this->redirect($this->generateUrl('admin_contact_index'));
            }
            
            $contact = new Contact();
            $contact->setSite($this->getUser()->getSite());
        }
        else{
            $contact = $this->getContactRepository()->findOneById($id);
            if($contact === null){
                //erreur
                $this->get('session')->getFlashBag()->add('error', "Contact introuvable");
                return $this->redirect($this->generateUrl('admin_contact_index'));
            }
            if($contact->getSite() !== $this->getUser()->getSite()){
                //erreur
                $this->get('session')->getFlashBag()->add('error', "Contact introuvable");
                return $this->redirect($this->generateUrl('admin_contact_index'));
            }
        }
        
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            try{
                if($contact->getId() === null){
                    $em->persist($contact);
                }
                $em->flush();
                $this->get('session')->getFlashBag()->add('success', "Contact enregistré");
                return $this->redirect($this->generateUrl("admin_contact_index"));
            } catch (\Exception $ex) {
                $this->get('session')->getFlashBag()->add('error', "Une erreur est survenue. Veuillez rééssayer");
            }
        }
        
        return array(
            'form' =>$form->createView(),
            'contact' => $contact
        );
    }
    
     /**
     * @Route("/{id}/delete", requirements={"id"="\d+"})
     */
    public function deleteAction(Request $request, $id){  
        $contact = $this->getContactRepository()->findOneById($id);
        if($contact === null){
            //erreur
            $this->get('session')->getFlashBag()->add('error', "Contact introuvable");
            return $this->redirect($this->generateUrl('admin_contact_index'));
        }
        if($contact->getSite() !== $this->getUser()->getSite()){
            //erreur
            $this->get('session')->getFlashBag()->add('error', "Contact introuvable");
            return $this->redirect($this->generateUrl('admin_contact_index'));
        }
        
        $form = $this->createFormBuilder()->getForm();
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            try{
                $em = $this->getDoctrine()->getManager();
                $em->remove($contact);
                $em->flush();
                $this->get('session')->getFlashBag()->add('success', "Contact supprimé");
                return $this->redirect($this->generateUrl("admin_contact_index"));
            } catch (\Exception $ex) {
                $this->get('session')->getFlashBag()->add('error', "Une erreur est survenue. Veuillez rééssayer");
            }
        }
        
        return array(
            'contact' => $contact,
            'form' => $form->createView()
        );
    }
    
    private function getContactRepository(){
        return $this->getDoctrine()->getRepository(Contact::class);
    }
    
   
}
