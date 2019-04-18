<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Site;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\ImageSite;

/**
 * @Template()
 */
class DefaultController extends Controller
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
