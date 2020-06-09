<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/boutique", name="boutique")
     */
    public function index(ProductRepository $productRepository)
    {
        $watches = $productRepository ->findAll();
        return $this->render('product/boutique.html.twig', [
            'watchesList' => $watches,
        ]);
    }
}
