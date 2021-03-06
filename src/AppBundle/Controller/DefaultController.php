<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Site;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use AppBundle\Entity\ImageSite;
use AppBundle\Controller\CheckSiteController;

/**
 * @Template()
 */
class DefaultController extends CheckSiteController
{
    
    /**
     * @Route("/{sitename}")
     */
    public function indexAction($sitename)
    {
        
        $site = $this->getSiteRepository()->findBySlug($sitename);
        if($site === null){
            throw new NotFoundHttpException('Site non trouvé');
        }
        
        //verifie la date du site
        $this->checkSite($site);
        
        return array(
            'site' => $site,
            'photos' => $site->getPictures()->filter(function($entry){
                return $entry instanceof ImageSite;
            })
        );
    }
    
    private function getSiteRepository(){
        return $this->getDoctrine()->getRepository(Site::class);
    }
}
