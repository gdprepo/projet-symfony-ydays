<?php

namespace App\Controller;

use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{


    /**
     * @Route("/default", name="default")
     */
    public function index(): Response
    {
        return $this->render('default/index.html.twig', [
  
        ]);
    }

        /**
     * @Route("/vip/success", name="success")
     * #isGranted('ROLE_1')
     */
    public function success(): Response
    {
        return $this->render('default/success.html.twig', [
  
        ]);
    }

        /**
     * @Route("/vip/error", name="error")
     */
    public function cancel(): Response
    {
        return $this->render('default/cancel.html.twig', [
  
        ]);
    }

        /**
     * @Route("/vip/create-checkout-session", name="checkout")
     */
    public function checkout(Request $request)
    {
        // $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
    
        \Stripe\Stripe::setApiKey('sk_test_51Gty04FbyARdQqIBN58cVTPuMnPrtoUzW7PO3SfxOxjSl9jVWoQ9uQ51JBnN2hesiQKjtstDM0GDBytYppAuXfEY00wR5yOgYi');

        $em = $this->getDoctrine()->getManager();
        $postData = json_decode($request->getContent());
        
        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
              'price_data' => [
                'currency' => 'eur',
                'product_data' => [
                  'name' => 'T-shirt',
                ],
                'unit_amount' => $postData->price,
              ],
              'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => $this->generateUrl('home', [
                $this->addFlash(
                    'message',
                    'Votre commande est validé !'
                ),
                $user = $this->getUser(),
                $user->setRoles(['ROLE_CLIENT']),
                $em->persist($user),
                $em->flush()
            ], UrlGeneratorInterface::ABSOLUTE_URL),
            'cancel_url' => $this->generateUrl('error', [], UrlGeneratorInterface::ABSOLUTE_URL),
          ]);

        return new JsonResponse(['id' => $session->id ]);
    }
}
