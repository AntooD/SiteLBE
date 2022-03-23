<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ProductDetailsController extends AbstractController
{
    /**
     * @Route("/details/{id}", name="product_detail")
     */
    public function index(Product $product): Response
    {
        return $this->render('product/details.html.twig', [
            'product' => $product,
        ]);
    }


    /**
     * @Route("/details/add/{id}", name="cart_add_this_product")
     */
    public function add(int $id, SessionInterface $session)
    {
        $basket = $session->get('basket', []);

        if(!empty($basket[$id])){
            $basket[$id]++;
        }else{
            $basket[$id] = 1;
        }
        
        $session->set('basket', $basket);

        return $this->redirectToRoute("cart_index");
    }
}