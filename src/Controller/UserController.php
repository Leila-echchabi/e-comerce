<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/profile", name="profile")
     */
    public function profile(User $user = null )
    {
        if($user === null){
            $user = $this-> getUser();
        }

        if($user === null){
            $user = $this-> redirectToRoute('home');
        }
        return $this->render('user/profile.html.twig', [
            'user' => $user,
        ]);
    }
}
