<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Image;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\ImageType;
use AppBundle\Entity\ImageSite;


/**
* @Route("/dashboard/photos")
* @Template()
*/
class ImageController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction(){
        
        $images = $this->getImageRepository()->findBy(array(
            'site' => $this->getUser()->getSite()
        ), array(
            'date' => 'DESC'
        ));
        
        return array(
            'images' => $images
        );
    }
    
    /**
     * @Route("/media/add")
     * @Route("/media/{id}/edit", requirements={"id"="\d+"})
     */
    public function editMediaAction(Request $request, $id = null){
        if($id === null){
            $image = new Image();
        }
        else{
            $image = $this->getImageRepository()->findOneById($id);
            if($image === null){
                //erreur
                $this->get('session')->getFlashBag()->add('error', "Média introuvable");
                return $this->redirect($this->generateUrl('admin_image_index'));
            }
            if($image->getSite() !== $this->getUser()->getSite()){
                //erreur
                $this->get('session')->getFlashBag()->add('error', "Média introuvable");
                return $this->redirect($this->generateUrl('admin_image_index'));
            }
            if($image instanceof ImageSite){
                return $this->redirect($this->generateUrl("admin_image_editphoto_1", array("id"=>$image->getId())));
            }
        }
        
        $form = $this->createForm(ImageType::class, $image);
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            try{
                $image->setSite($this->getUser()->getSite());
                $em = $this->getDoctrine()->getManager();
                if($image->getId() === null){
                    $em->persist($image);
                }
                $em->flush();
                
                $this->get('session')->getFlashBag()->add('success', "Média enregistré");
                return $this->redirect($this->generateUrl("admin_image_index"));
                
            } catch (\Exception $ex) {
                dump($ex);die;
                $this->get('session')->getFlashBag()->add('error', "Une erreur est survenue. Veuillez rééssayer");
            }
        }
        
        return array(
            'image' => $image,
            'form' =>$form->createView()
        );
        
    }
    
    /**
     * @Route("/album/add")
     * @Route("/album/{id}/edit", requirements={"id"="\d+"})
     */
    public function editPhotoAction(Request $request, $id = null){
        if($id === null){
            $imageSite = new ImageSite();
        }
        else{
            $imageSite = $this->getImageSiteRepository()->findOneById($id);
            if($imageSite === null){
                //erreur
                $this->get('session')->getFlashBag()->add('error', "Photo introuvable");
                return $this->redirect($this->generateUrl('admin_image_index'));
            }
            if($imageSite->getSite() !== $this->getUser()->getSite()){
                //erreur
                $this->get('session')->getFlashBag()->add('error', "Photo introuvable");
                return $this->redirect($this->generateUrl('admin_image_index'));
            }
        }
        
        
        $form = $this->createForm(ImageType::class, $imageSite);
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            try{
                $imageSite->setSite($this->getUser()->getSite());
                
                //todo : thumlbnails
                
                $em = $this->getDoctrine()->getManager();
                if($imageSite->getId() === null){
                    $em->persist($imageSite);
                }
                $em->flush();
                
                $this->get('session')->getFlashBag()->add('success', "Photo enregistrée");
                return $this->redirect($this->generateUrl("admin_image_index"));
                
            } catch (\Exception $ex) {
                dump($ex);die;
                $this->get('session')->getFlashBag()->add('error', "Une erreur est survenue. Veuillez rééssayer");
            }
        }
        
        return $this->render("AdminBundle:Image:edit_media.html.twig", array(
            'image' =>$imageSite,
            'form' => $form->createView()
        ));
    }
    
    /**
     * @Route("/{id}/delete", requirements={"id"="\d+"})
     */
    public function deleteAction(Request $request, $id){
        
        $image = $this->getImageRepository()->findOneById($id);
        if($image === null){
            //erreur
            $this->get('session')->getFlashBag()->add('error', "Image introuvable");
            return $this->redirect($this->generateUrl('admin_image_index'));
        }
        if($image->getSite() !== $this->getUser()->getSite()){
            //erreur
            $this->get('session')->getFlashBag()->add('error', "Image introuvable");
            return $this->redirect($this->generateUrl('admin_image_index'));
        }
        
        $form = $this->createFormBuilder()->getForm();
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            try{
                $em->remove($image);
                $em->flush();
                $this->get('session')->getFlashBag()->add('success', "Image supprimée");
                return $this->redirect($this->generateUrl("admin_image_index"));
            } catch (\Exception $ex) {
                $this->get('session')->getFlashBag()->add('error', "Erreur lors de la suppression");
            }
        }
        
        
        return array(
            'image' => $image,
            'form' => $form->createView()
        );
    }
    
    private function getImageRepository(){
        return $this->getDoctrine()->getRepository(Image::class);
    }
    
    private function getImageSiteRepository(){
        return $this->getDoctrine()->getRepository(ImageSite::class);
    }
}
