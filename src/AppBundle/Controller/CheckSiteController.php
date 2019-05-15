<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Site;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class CheckSiteController extends Controller{
    
    protected function checkSite(Site $site){
        $endDate = clone $site->getCreateDate();
        $endDate->modify('+'.$site->getSubscription()->getNbMonth().' month');
        
        $now = new \DateTime();
        
        if($endDate < $now){
            throw new NotFoundHttpException("Site non trouvé");
        }
        
        return;
    }
    
}
