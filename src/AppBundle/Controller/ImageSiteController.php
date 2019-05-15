<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\ImageSite;
use AppBundle\Entity\Site;
use AppBundle\Controller\CheckSiteController;

/**
* @Route("/{sitename}/photos")
* @Template()
*/
class ImageSiteController extends CheckSiteController
{
    /**
     * @Route("/")
     */
    public function indexAction($sitename){
        
        $site = $this->getSiteRepository()->findBySlug($sitename);
        
        $this->checkSite($site);
        
        $photos = $this->getImageSiteRepository()->findBySite($site);
        
        return array(
            'site' => $site,
            'photos' => $photos
        );
    }
    
    private function getSiteRepository(){
        return $this->getDoctrine()->getRepository(Site::class);
    }
    
    private function getImageSiteRepository(){
        return $this->getDoctrine()->getRepository(ImageSite::class);
    }
}
