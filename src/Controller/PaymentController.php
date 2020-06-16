<?php

namespace App\Controller;

use App\Service\cart\CartService;
use Stripe\PaymentIntent;
use Stripe\Stripe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PaymentController extends AbstractController
{


    /**
     * @param Request     $request
     * @param CartService $cartService
     * @Route("/payment", name="payment")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function paymentCart(Request $request, CartService $cartService){
        $products = $cartService->getFullCart();
        if ($request->isMethod('POST')){
            $token = $request->get('stripeToken');

            $stripe = new \Stripe\StripeClient('sk_test_51GuPf9FpvzVGjfHUiIh0BDP7ke1XbaPTUZVY55LxWeCVkgqVe51WIC5288XRlHIM2CgmZ9S3HqVOlIMqlyWFvuy300b6BA63PV'
            );
            $stripe->charges->create([
                'amount' => $cartService->getTotal()*100,
                'currency' => 'eur',
                'source' => $token,
                'description' => 'My First Test Charge (created for API docs)',
            ]);

            $cartService->deleteCart();
            $this->addFlash('success', 'Commande validée');

            return $this->redirectToRoute('home');
        }

        return $this->render('payment/payment.html.twig', array(
            'cart_service'=>$cartService
        ));
    }

    /**
     * @param CartService $cartService
     * @Route("/intent", name="intent")
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function intent(CartService $cartService)

    {
        Stripe::setApiKey('sk_test_51GuPf9FpvzVGjfHUiIh0BDP7ke1XbaPTUZVY55LxWeCVkgqVe51WIC5288XRlHIM2CgmZ9S3HqVOlIMqlyWFvuy300b6BA63PV');

//        $token = $_POST['stripeToken'];
        $intent = PaymentIntent::create([
            'amount' =>  $cartService->getTotal()*100,
            'currency' => 'eur',
            'metadata' => ['integration_check' => 'accept_a_payment'],

        ]);

        return $this->render('payment/payment.html.twig', array(
            'cart_service'=>$cartService,
            'intent'=>$intent
        ));
    }
}
