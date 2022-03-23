<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Repository\ProductRepository;

class CartController extends AbstractController
{

    public $total = 0;
    /**
     * @Route("/panier", name="cart_index")
     */
    public function index(SessionInterface $session, ProductRepository $productRepository)
    {
        $basket = $session->get('basket', []);

        $basketWithData = [];

        foreach($basket as $id => $quantity){
            $basketWithData[]= [
                'product' => $productRepository->find($id),
                'quantity'=> $quantity,
            ];
        }

        $total = 0;

        foreach($basketWithData as $item){
            $totalItem = $item['product']->getPrice() * $item['quantity'];
            $total += $totalItem;
        }

        return $this->render('cart/index.html.twig', [
            'items' => $basketWithData,
            'total' => $total,
        ]);
    
    }

    /**
     * @Route("/panier/add/{id}", name="cart_add")
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
        return $this->redirectToRoute("product_index");
    }

}
