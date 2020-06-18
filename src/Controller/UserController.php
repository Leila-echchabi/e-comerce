<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\User;
use App\Repository\OrderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/profil", name="profil")
     */
    public function profil(User $user = null )
    {
        if($user === null){
            $user = $this-> getUser();
        }

        if($user === null){
            $user = $this-> redirectToRoute('home');
        }
        return $this->render('user/profil.html.twig', [
            'user' => $user,
        ]);
    }

    public function orders (Order $order, OrderRepository $orderRepository){
        if(!empty($order)){
            $order=$this->getOrders();
        }
        return $this->render('user/profil.html.twig', [
            'orders' => $this->getOrder,
        ]);


    }

    /**
     * @Route("/details/{id}", name="details")
     */
    public function details(Order $order){
        return $this->render('user/details.html.twig',[
           'order'=>$order
        ]);
    }
}
