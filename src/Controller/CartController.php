<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use App\Service\cart\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="cart")
     */
    public function index(SessionInterface $session, ProductRepository $productRepository)
    {
        $panier = $session->get('panier',[]);
        $panierWithData = [];

        foreach ($panier as $id => $quantity){
            $panierWithData[] = [
                'watch'=> $productRepository->find($id),
                'quantity'=>$quantity
            ];
        }

//        dd($panierWithData);
        $total = 0;

        foreach ($panierWithData as $item){
            $totalItem = $item['watch']->getPrice() * $item['quantity'];
            $total += $totalItem;
        }


        return $this->render('cart/panier.html.twig', [
            'items'=>$panierWithData,
            'total'=>$total
        ]);
    }

    /**
     * @Route("/cart/add/{id}", name="add_cart")
     */
    public function add($id,CartService $cartService)
    {
        $cartService->add($id);
        return $this->redirectToRoute("cart");
    }

    /**
     * @Route("/cart/remove/{id}", name="remove_cart")
     */
    public function remove($id, SessionInterface $session){
        $panier = $session->get('panier', []);
        if(!empty($panier[$id])){
            unset($panier[$id]);
        }

        $session->set('panier',$panier);
        return $this->redirectToRoute("cart");
    }
}
