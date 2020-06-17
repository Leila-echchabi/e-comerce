<?php

namespace App\Service\cart;

use App\Entity\User;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartService{

    protected $session;
    protected $productRepository;

    public function __construct(SessionInterface $session, ProductRepository $productRepository)
    {
        $this->session = $session;
        $this->productRepository = $productRepository;
    }

    public function add(int $id)
    {
        $panier = $this->session->get('panier',[]);

        if(!empty($panier[$id])) {
            $panier[$id]++;
        }else{
            $panier[$id]=1;
        }

        $this->session->set('panier', $panier);
    }

    public function remove(int $id)
    {
        $panier = $this->session->get('panier', []);
        if(!empty($panier[$id])){
            unset($panier[$id]);
        }
        $this->session->set('panier',$panier);
    }

    public function getFullCart() : array{

        $panier = $this->session->get('panier',[]);
        $panierWithData = [];

        foreach ($panier as $id => $quantity){
            $panierWithData[] = [
                'watch'=> $this->productRepository->find($id),
                'quantity'=>$quantity
            ];
        }
        return $panierWithData;
    }

    public function getDetailCart() : array{

        $panier = $this->session->get('panier',[]);
        $panierWithData = [];

        foreach ($panier as $id => $quantity){
            $panierWithDatail[] = [
                'watch.name'=> $this->productRepository->find($id)->getName(),
                'watch.price'=>$this->productRepository->find($id)->getPrice(),
                'quantity'=>$quantity
            ];
        }
        return $panierWithDatail;
    }

    public function getTotal() : float{
        $total = 0;

        foreach ($this->getFullCart() as $item){
           $total += $item['watch']->getPrice() * $item['quantity'];
        }
        return $total;
    }

    public function getTotalQuantity() : int {
        $totalQuantity = 0;

        foreach ($this->getFullCart() as $item){
            $totalQuantity += $item['quantity'];
        }
        return $totalQuantity;
    }

    public function deleteCart(){

        if(!empty($panier)){
            unset($panier);
        }
        $this->session->clear();
    }

}