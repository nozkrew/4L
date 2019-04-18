<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Article;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\ArticleType;
use FOS\UserBundle\Form\Type\RegistrationFormType;

/**
* @Route("/dashboard/articles")
* @Template()
*/
class ArticleController extends Controller{
    /**
     * @Route("/")
     */
    public function indexAction(){        
        $articles = $this->getArticleRepository()->findBy(array(
            'site'=>$this->getUser()->getSite()
        ));
        
        return array(
            'articles' => $articles
        );
    }
    
    /**
     * @Route("/add")
     * @Route("/{id}/edit", requirements={"id"="\d+"})
     */
    public function editAction(Request $request, $id = null){
        if($id === null){
            $article = new Article();
        }
        else{
            $article = $this->getArticleRepository()->findOneById($id);
        
            if($article === null){
                //erreur article introuvable
                //redirection index article
                $this->get('session')->getFlashBag()->add('error', "Article introuvable");
                return $this->redirect($this->generateUrl('admin_article_index'));
            }

            if($article->getSite() !== $this->getUser()->getSite()){
                //erreur mauve
                //redirection index article
                $this->get('session')->getFlashBag()->add('error', "Article introuvable");
                return $this->redirect($this->generateUrl('admin_article_index'));
            }
        }
        
        $form = $this->createForm(ArticleType::class, $article, array(
            'site' => $this->getUser()->getSite()
        ));
        
        $form->handleRequest($request);
        if($form->isValid() && $form->isSubmitted()){
            try{
                
                $article->setSite($this->getUser()->getSite());
                
                $em = $this->getDoctrine()->getManager();
                if($article->getId() === null){
                    $em->persist($article);
                }
                $em->flush();
                
                $this->get('session')->getFlashBag()->add('success', "Article enregistré");
                return $this->redirect($this->generateUrl("admin_article_index"));
                
            } catch (\Exception $ex) {
                $this->get('session')->getFlashBag()->add('error', "Une erreur est survenue. Veuillez rééssayer");
            }
        }
        
        return array(
            'article' => $article,
            'form' => $form->createView()
        );
    }
    
    /**
     * @Route("/{id}/delete", requirements={"id"="\d+"})
     */
    public function deleteAction(Request $request, $id){
        $article = $this->getArticleRepository()->findOneById($id);
        
        if($article === null){
            //erreur article introuvable
            //redirection index article
            $this->get('session')->getFlashBag()->add('error', "Article introuvable");
            return $this->redirect($this->generateUrl('admin_article_index'));
        }

        if($article->getSite() !== $this->getUser()->getSite()){
            //erreur mauve
            //redirection index article
            $this->get('session')->getFlashBag()->add('error', "Article introuvable");
            return $this->redirect($this->generateUrl('admin_article_index'));
        }
        
        $form = $this->createFormBuilder()->getForm();
        
        $form->handleRequest($request);
        if($form->isValid() && $form->isSubmitted()){
            try{
                $em = $this->getDoctrine()->getManager();
                $em->remove($article);
                $em->flush();
                
                $this->get('session')->getFlashBag()->add('success', "Article supprimé");
                return $this->redirect($this->generateUrl("admin_article_index"));
            } catch (\Exception $ex) {
                $this->get('session')->getFlashBag()->add('error', "Une erreur est survenue. Veuillez rééssayer");
            }
            
        }
        
        return array(
            'article' => $article,
            'form' => $form->createView()
        );
    }
    
    private function getArticleRepository(){
        return $this->getDoctrine()->getRepository(Article::class);
    }
}
