<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/boutique", name="boutique")
     */
    public function index(ProductRepository $productRepository, Request $request, PaginatorInterface $paginator)
    {
        $data = $productRepository ->findAll();

        $watches = $paginator->paginate(
            $data,
            $request->query->getInt('page', 1),
            6
        );

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
