<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Subscription;
use AppBundle\Form\PaiementType;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Template()
 */
class PaiementController extends Controller
{
    /**
     * @Route("/paiement/{slug}")
     */
    public function paiementAction(Request$request, $slug){
        
        //si pas authentifier, on redirige vers login
        if(!$this->container->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')){
            //voir comment on redirige
            return $this->redirect($this->generateUrl("fos_user_security_login"));
        }
        
        $subscription = $this->getSubscriptionRepository()->findOneBySlug($slug);
        
        $form = $this->createForm(PaiementType::class);

        $form->handleRequest($request);
        
        //form valid
        if($form->isSubmitted() && $form->isValid()){
        
            // Set your secret key: remember to change this to your live secret key in production
            // See your keys here: https://dashboard.stripe.com/account/apikeys
            \Stripe\Stripe::setApiKey($this->getParameter('stripe_secret_key'));

            // Token is created using Checkout or Elements!
            // Get the payment token ID submitted by the form:
            $token = $request->request->get('stripeToken');
            $charge = \Stripe\Charge::create([
                'amount' => ($subscription->getPrice() * 100),
                'currency' => 'eur',
                'description' => 'Example charge',
                'source' => $token,
            ]);
        
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
