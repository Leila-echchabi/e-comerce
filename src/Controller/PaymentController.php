<?php

namespace App\Controller;


use App\Entity\Order;
use App\Form\FormPaymentType;
use App\Form\PaymentFormType;
use App\Service\cart\CartService;
use Doctrine\ORM\EntityManagerInterface;
use Stripe\PaymentIntent;
use Stripe\Stripe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PaymentController extends AbstractController
{

    public function createOrder(Request $request, CartService $cartService, EntityManagerInterface $em){
        $items = $cartService->getFullCart();

        $order = new Order();
        $order->setNumber('ORDER');
        $order->setDate(new \DateTime());
        $order->setAmount($cartService->getTotal());
        $order->setDetails($cartService->getDetailCart());
        $order->setUserId($this->getUser());

        $em->persist($order);
        $em->flush();
    }

    /**
     * @param CartService $cartService
     * @param Request     $request
     *@Route("/intent", name="intent")
     * @return Response
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function intent(Request $request, CartService $cartService)
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

    /**
     * @param Request     $request
     * @param CartService $cartService
     * @Route("/payment", name="payment")
     * @Route("/profile", name="profile")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function paymentCart(Request $request, CartService $cartService, EntityManagerInterface $em){

        $order = $this->createOrder($request,$cartService,$em);
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

            return $this->redirectToRoute('profile');
        }

        return $this->render('user/profile.html.twig', array(
            'cart_service'=>$cartService,
            'order'=>$order
        ));
    }

}