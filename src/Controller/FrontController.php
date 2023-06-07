<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends AbstractController
{
    // #[Route('/{reactRouting}', name: 'app_front', requirements:{'reactRouting'='^(?!api).+'}, defaults:{'reactRouting': null})]
    public function index()
    {
        return $this->render('front/index.html.twig');
    }
}
