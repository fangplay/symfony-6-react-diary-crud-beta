<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DiaryController extends AbstractController
{
    #[Route('/diary', name: 'app_diary')]
    public function index(): Response
    {
        return $this->render('diary/index.html.twig', [
            'controller_name' => 'DiaryController',
        ]);
    }
}
