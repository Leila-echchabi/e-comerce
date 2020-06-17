<?php

namespace App\Controller;


use App\Entity\User;
use App\Service\cart\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="cart")
     */
    public function index(CartService $cartService)
    {

        return $this->render('cart/panier.html.twig', [
            'cart_service'=>$cartService,
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
        $cartService->deleteCart();
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

    /**
     * @param Request     $request
     * @param CartService $cartService
     * @Route("/cart/validate", name="validate_cart")
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function validateCart(Request $request, CartService $cartService){

        if($request->isMethod('POST')){
            $user = $this->getUser();
            $montantTotal = $cartService->getTotal();
            $cartService->getFullCart();
        };
        return $this->render('payment/payment.html.twig', array(
            'user'=> $this->getUser(),
            'cart_service'=>$cartService
        ));
    }

}
