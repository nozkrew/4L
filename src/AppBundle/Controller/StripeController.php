<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use AppBundle\Event\StripeEvent;
use Stripe\Webhook;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/stripe")
 */
class StripeController extends Controller
{
    /**
     * @Route("/wh")
     */
    public function webhookAction(Request $request){
        
        $header = 'Stripe-Signature';
        $signature = $request->headers->get($header);
        
        if (is_null($signature)) {
            throw new BadRequestHttpException(sprintf('Missing header %s', $header));
        }
        
        try {
            $event = new StripeEvent(Webhook::constructEvent($request->getContent(), $signature, $this->getParameter('stripe_signing_secret')));
        } catch (\UnexpectedValueException $e) {
            throw new BadRequestHttpException('Invalid Stripe payload');
        } catch (SignatureVerification $e) {
            throw new BadRequestHttpException('Invalid Stripe signature');
        }
        
        $this->get('event_dispatcher')->dispatch($event->getName(), $event);
        
        return new Response();
    }
}
