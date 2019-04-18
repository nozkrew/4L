<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\ImageSite;
use AppBundle\Entity\Site;

/**
* @Route("/{sitename}/photos")
* @Template()
*/
class ImageSiteController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction($sitename){
        
        $site = $this->getSiteRepository()->findBySlug($sitename);
        
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
