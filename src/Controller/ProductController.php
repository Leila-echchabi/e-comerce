<?php

namespace App\Controller;

use App\Entity\Product;
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

    /**
     * @Route("/detail/{id<\d+>}", name="detail")
     */
    public function detail( Product $watch)
    {

        return $this->render('product/detail.html.twig', [
            'watch' => $watch,
        ]);
    }
}
