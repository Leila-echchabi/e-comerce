<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="cart")
     */
    public function index()
    {
        return $this->render('cart/panier.html.twig', [
//            'controller_name' => 'CartController',
        ]);
    }
    /**
     * @Route("/cart/add/{id}", name="cart")
     */
    public function add($id,Request $request)
    {
        $session = $request->getSession();

        $panier = $session->get('panier',[]);

        if(!empty($panier[$id])) {
            $panier[$id]++;
        }else{
            $panier[$id]=1;
        }


        $session->set('panier', $panier);

        dd($session->get('panier'));

    }
}
