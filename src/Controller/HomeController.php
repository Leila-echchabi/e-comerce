<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("", name="home")
     */
    public function index()
    {
        return $this->render('home/payment.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("a_propos", name="a_propos")
     */
    public function aPropos()
    {
        return $this->render('home/a_propos.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("faq", name="faq")
     */
    public function faq()
    {
        return $this->render('home/faq.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("contact", name="contact")
     */
    public function contact()
    {
        return $this->render('home/contact.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
