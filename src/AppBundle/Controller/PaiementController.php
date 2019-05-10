<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Subscription;
use AppBundle\Form\PaiementType;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Section;
use AppBundle\Entity\Paiement;

/**
 * @Template()
 */
class PaiementController extends Controller
{
    /**
     * @Route("/paiement/{slug}")
     */
    public function paiementAction(Request $request, $slug){        
        //si pas authentifier, on redirige vers login
        if(!$this->container->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')){
            //voir comment on redirige
            return $this->redirect($this->generateUrl("fos_user_security_login"));
        }
        
        $subscription = $this->getSubscriptionRepository()->findOneBySlug($slug);
        
        $paiement = new Paiement();
        
        $form = $this->createForm(PaiementType::class, $paiement);

        $form->handleRequest($request);
        
        //form valid
        if($form->isSubmitted() && $form->isValid()){
            
            try{
                \Stripe\Stripe::setApiKey($this->getParameter('stripe_secret_key'));

                $token = $request->request->get('stripeToken');
                $charge = \Stripe\Charge::create([
                    'amount' => ($subscription->getPrice() * 100),
                    'currency' => 'eur',
                    'description' => 'Example charge',
                    'source' => $token,
                ]);
                
            }
            catch(\Stripe\Error\Base $ex){
                //erreur de paiment,
                dump($ex);die;
            }
            finally {
                $paiement->setUser($this->getUser());
                $paiement->setChargeId($charge->id);
                $paiement->setSubscription($subscription);
                $em = $this->getDoctrine()->getManager();
                $em->persist($paiement);
                $em->flush();
                
                //success redirige
            }
        }
        
        return array(
            'subscription' => $subscription,
            'form' =>$form->createView(),
            'stripe_public_key' => $this->container->getParameter("stripe_public_key")
        );
        
    }
    
    private function getSubscriptionRepository(){
        return $this->getDoctrine()->getRepository(Subscription::class);
    }
    
}
