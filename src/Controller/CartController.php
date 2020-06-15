<?php

namespace App\Controller;


use App\Service\cart\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="cart")
     */
    public function index(CartService $cartService)
    {

        return $this->render('cart/panier.html.twig', [
            'items'=> $cartService->getFullCart(),
            'total'=>$cartService->getTotal()
        ]);
    }

    /**
     * @Route("/cart/add/{id}", name="add_cart")
     */
    public function add($id,CartService $cartService)
    {
        $cartService->add($id);

        return $this->redirectToRoute("boutique");
    }

    /**
     * @Route("/cart/remove/{id}", name="remove_cart")
     */
    public function remove($id, CartService $cartService){
        $cartService->remove($id);
        return $this->redirectToRoute("cart");
    }

    /**
     * @Route("/cart/delete", name="delete_cart")
     */
    public function delete(CartService $cartService){
        $cartService->deletePanier();
        return $this->redirectToRoute("cart");
    }
//    public function totalQuantity(CartService $cartService)
//    {
//
//        return $this->render('cart/panier.html.twig', [
//            'totalQuantity'=> $cartService->getTotalQuantity(),
//        ]);
//
//        return $this->render('base.html.twig', [
//            'totalQuantity'=> $cartService->getTotalQuantity(),
//        ]);
//    }

}
