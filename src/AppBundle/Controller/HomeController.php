<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Subscription;

/**
 * @Template()
 */
class HomeController extends Controller
{
    /**
     * @Route("/")
     */
    public function homeAction(){
        
        $subscriptions = $this->getSubscriptionRepository()->findAll();
        
        return array(
            'subscriptions' => $subscriptions
        );
    }
    
    private function getSubscriptionRepository(){
        return $this->getDoctrine()->getRepository(Subscription::class);
    }
       
}
