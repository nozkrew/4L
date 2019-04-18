<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\ImageType;
use AppBundle\Entity\SectionSite;
use AppBundle\Form\SectionSiteType;
use AppBundle\Entity\Partner;
use UserBundle\Form\UserType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Entity\Image;
use AppBundle\Repository\ImageRepository;
use AppBundle\Form\ImageChoiceType;

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
        
        $form = $this->createFormBuilder($site)
                ->add('users', CollectionType::class, array(
                    'entry_type' => UserType::class,
                    'entry_options' => array(
                        'site' =>$site
                    ),
                    'by_reference' => false
                ))
                ->add('headerImage', ImageChoiceType::class, array(
                    'query_builder' => function(ImageRepository $ir){
                        return $ir->createQueryBuilder('i')
                                ->where('i.site = :site')
                                ->setParameter('site', $this->getUser()->getSite());
                    }
                ))
                ->add('twitter', null, array(
                    'required' => false
                ))
                ->add('facebook', null, array(
                    'required' => false
                ))
                ->add('instagram', null, array(
                    'required' => false
                ))
                ->getForm();
        
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
