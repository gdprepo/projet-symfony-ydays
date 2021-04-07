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
        return $this->render('default/index.html.twig', []);
    }

    /**
     * @Route("/vip/success", name="success")
     * #isGranted('ROLE_1')
     */
    public function success(): Response
    {
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        \Stripe\Stripe::setApiKey('sk_test_51Gty04FbyARdQqIBN58cVTPuMnPrtoUzW7PO3SfxOxjSl9jVWoQ9uQ51JBnN2hesiQKjtstDM0GDBytYppAuXfEY00wR5yOgYi');

        $parts = parse_url($actual_link);
        parse_str($parts['query'], $query);


        if ($query['session_id']) {
            $session = \Stripe\Checkout\Session::retrieve($query['session_id']);

            if ($session['payment_status']) {
                $em = $this->getDoctrine()->getManager();

                $this->addFlash(
                    'message',
                    'Votre commande est validé !'
                );
                $user = $this->getUser();
                $user->setRoles(['ROLE_CLIENT']);
                $em->persist($user);
                $em->flush();
            };

        }




        return $this->render('default/success.html.twig', []);
    }

    /**
     * @Route("/vip/error", name="error")
     */
    public function cancel(): Response
    {
        return $this->render('default/cancel.html.twig', []);
    }

    /**
     * @Route("/vip/create-checkout-session", name="checkout")
     */
    public function checkout(Request $request)
    {
        // $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        \Stripe\Stripe::setApiKey('sk_test_51Gty04FbyARdQqIBN58cVTPuMnPrtoUzW7PO3SfxOxjSl9jVWoQ9uQ51JBnN2hesiQKjtstDM0GDBytYppAuXfEY00wR5yOgYi');



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
            'success_url' => "http://127.0.0.1:8080/vip/success?session_id={CHECKOUT_SESSION_ID}",
            'cancel_url' => $this->generateUrl('error', [], UrlGeneratorInterface::ABSOLUTE_URL),
        ]);

        return new JsonResponse(['id' => $session->id]);
    }
}
