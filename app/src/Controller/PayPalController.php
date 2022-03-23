<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PayPalController extends AbstractController
{
    #[Route('/Paiement', name: 'paiement')]
    public function index(): Response
    {
        return $this->render('paypal/index.html.twig', [
            'controller_name' => 'PayPalController',
        ]);
    }
}
