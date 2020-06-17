<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Form\FormPaymentType;
use App\Form\PaymentFormType;
use App\Service\cart\CartService;
use Stripe\PaymentIntent;
use Stripe\Stripe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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

            $stripe = new \Stripe\StripeClient('sk_test_51GtkFUFdOQZQgragxcsaXkplUjYJ4Cd4Ai6FJ8YW2B8rPgYNnBN0VtKBdZoOfiPmtVW7oNXW9aK1AcGdUDnmNPth00k8tdKlXT'
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
     * @param Request     $request
     *@Route("/intent", name="intent")
     * @return Response
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function intent(CartService $cartService, Request $request)
    {
        $form = $this->createForm(PaymentFormType::class);
        $form->handleRequest($request);

        Stripe::setApiKey('sk_test_51GtkFUFdOQZQgragxcsaXkplUjYJ4Cd4Ai6FJ8YW2B8rPgYNnBN0VtKBdZoOfiPmtVW7oNXW9aK1AcGdUDnmNPth00k8tdKlXT');

//        $token = $_POST['stripeToken'];
        $intent = PaymentIntent::create([
            'amount' =>  $cartService->getTotal()*100,
            'currency' => 'eur',
            'metadata' => ['integration_check' => 'accept_a_payment'],

        ]);

        return $this->render('payment/payment.html.twig', array(
            'paymentForm' => $form->createView(),
            'intent'=>$intent
        ));
    }

}