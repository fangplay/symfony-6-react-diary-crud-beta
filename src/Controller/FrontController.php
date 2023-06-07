<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends AbstractController
{
    // #[Route('/front', name: 'app_front')]
    // public function index(): Response
    // {
    //     return $this->render('front/index.html.twig', [
    //         'controller_name' => 'FrontController',
    //     ]);
    // }
    #[Route('/{reactRouting}', name: 'app_front', requirements:{'reactRouting'='^(?!api).+'}, defaults:{'reactRouting': null})]
    public function index()
    {
        return $this->render('front/index.html.twig');
    }
}
