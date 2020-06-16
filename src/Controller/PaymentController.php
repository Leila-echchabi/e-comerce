<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PaymentController extends AbstractController
{
    /**
     * @Route("/payment", name="payment")
     */
    public function index(Request $request)
    {
        \Stripe\Stripe::setApiKey('
sk_test_51GuPf9FpvzVGjfHUiIh0BDP7ke1XbaPTUZVY55LxWeCVkgqVe51WIC5288XRlHIM2CgmZ9S3HqVOlIMqlyWFvuy300b6BA63PV');

        $request = $_POST['stripeToken'];
        $charge = \Stripe\Charge::create([
            'amount' => 999,
            'currency' => 'eur',
            'description' => 'Paiement de test',
            'source' => $request
        ]);

        return $this->render('payment/payment.html.twig', [
            'controller_name' => 'PaymentController',
        ]);
    }
}
