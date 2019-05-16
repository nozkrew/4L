<?php

namespace AppBundle\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Event\StripeEvent;
use AppBundle\Entity\Site;
use AppBundle\Entity\Paiement;
use AppBundle\Entity\Section;
use AppBundle\Entity\SectionSite;
use UserBundle\Entity\User;

class StripeEventSubscriber implements EventSubscriberInterface{
    
    private $em;
    
    public function __construct(EntityManagerInterface $em){
      $this->em = $em;
    }
    
    public static function getSubscribedEvents(){
      return [
        'charge.succeeded' => ['onChargeSucceeded'],
      ];
    }
    
    public function onChargeSucceeded(StripeEvent $event){
        /** @var Charge $charge */
        $charge = $event->getResource();
        
        $paiement = $this->getPaiementRepository()->findOneBy(array(
            'chargeId' => $charge->id
        ));
        
        if($paiement === null){
            //return erreur
        }

        $password = bin2hex(random_bytes(5));

        $user2 = new User();
        $user2->setEmail($paiement->getSecondUserEmail());
        $user2->setFirstname($paiement->getSecondUserFirstname());
        $user2->setLastname($paiement->getSecondUserLastname());
        $user2->setUsername($paiement->getSecondUserUsername());
        $user2->setPlainPassword($password);
        $user2->setEnabled(true);

        $this->em->persist($user2);

        $site = new Site();
        $site->setName($paiement->getSiteName());
        $site->setSubscription($paiement->getSubscription());
        $site->addUser($paiement->getUser());
        $site->addUser($user2);

        $this->em->persist($site);

        $sections = $this->getSectionRepository()->findAll();

        foreach($sections as $key => $section){
            $sectionSite = new SectionSite();
            $sectionSite->setSection($section);
            $sectionSite->setSite($site);
            $sectionSite->setOrdering($key + 1);
            $sectionSite->setContent('');
            $this->em->persist($section);
        }

        try{
            $this->em->flush();
        } catch (\Exception $ex) {
            echo $ex->getMessage();
            //erreur génération site
        }
        
        
    }
    
    private function getPaiementRepository(){
        return $this->em->getRepository(Paiement::class);
    }
    
    private function getSectionRepository(){
        return $this->em->getRepository(Section::class);
    }
}
