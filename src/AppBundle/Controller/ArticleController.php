<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Article;
use AppBundle\Entity\Site;
use AppBundle\Controller\CheckSiteController;

/**
* @Route("/{sitename}/article")
* @Template()
*/
class ArticleController extends CheckSiteController
{
    /**
     * @Route("/")
     */
    public function indexAction($sitename){
        
        $site = $this->getSiteRepository()->findBySlug($sitename);
        
        $this->checkSite($site);
        
        //Liste des articles
        $articles = $this->getArticleRepository()->findBySite($sitename);
        
        //var_dump($articles);die;
        
        
        return array(
            'site' => $site,
            'articles' => $articles
        );
    }
    
    /**
     * @Route("/{slug}")
     */
    public function viewAction($sitename, $slug){
        
        $site = $this->getSiteRepository()->findBySlug($sitename);
        
        $this->checkSite($site);
        
        $articles = $this->getArticleRepository()->findBySite($sitename);
        
        $article = null;
        foreach($articles as $art){
            if($art->getSlug() == $slug){
                $article = $art;
            }
        }
        
        if($article == null){
            //retourne erreur
        }
        
        $others = array();
        if(count($articles) == 1){
            $keys = array(0);
        }
        elseif (count($articles) < 4){
            $keys = array_rand($articles, count($articles));
        }
        else{
            $keys = array_rand($articles, 4);
        }
        foreach($keys as $key){
            $others[] = $articles[$key];
        }
        
        
        
        return array(
            'site' => $site,
            'article' => $article,
            'others' => $others
        );
    }
    
    private function getArticleRepository(){
        return $this->getDoctrine()->getRepository(Article::class);
    }
    
    private function getSiteRepository(){
        return $this->getDoctrine()->getRepository(Site::class);
    }
}
