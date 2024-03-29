<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contactclient')]
    public function contactclient(): Response
    {
        return $this->render('contact_client/index.html.twig', [
            'controller_name' => 'ContactClientController',
        ]);
    }

    #[Route('/contact')]
    public function index(): Response
    {
        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
        ]);
    }
}
