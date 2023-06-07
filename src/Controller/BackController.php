<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Diary;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
class BackController extends AbstractController
{
    // #[Route('/back', name: 'back_index', methods:{'GET'})]
    public function index(ManagerRegistry $doctrine): Response
    {
        $diaries = $doctrine
            ->getRepository(Diary::class)
            ->findAll();
   
        $data = [];
   
        foreach ($diaries as $diary) {
           $data[] = [
               'id' => $diary->getId(),
               'title' => $diary->getTitle(),
               'date' => $diary->getDate(),
               'type' => $diary->getType(),
               'description' => $diary->getDescription(),
           ];
        }
   
   
        return $this->json($data);
    }
    
    // #[Route('/back', name: 'back_new', methods:{'POST'})]
    public function new(ManagerRegistry $doctrine, Request $request): Response
    {
        $entityManager = $doctrine->getManager();
   
        $diary = new Diary();
        $diary->setTitle($request->request->get('title'));
        $diary->setDate($request->request->get('date'));
        $diary->setType($request->request->get('type'));
        $diary->setDescription($request->request->get('description'));
   
        $entityManager->persist($diary);
        $entityManager->flush();
   
        return $this->json('Created new diary successfully with id ' . $diary->getId());
    }

    // #[Route('/back/{id}', name: 'back_show', methods:{'GET'})]
    public function show(ManagerRegistry $doctrine, int $id): Response
    {
        $diary = $doctrine->getRepository(Diary::class)->find($id);
   
        if (!$diary) {
   
            return $this->json('No diary found for id' . $id, 404);
        }
   
        $data =  [
            'id' => $diary->getId(),
            'title' => $diary->getTitle(),
            'date' => $diary->getDate(),
            'type' => $diary->getType(),
            'description' => $diary->getDescription(),
        ];
           
        return $this->json($data);
    }

    // #[Route('/back/{id}', name: 'back_edit', methods:{'PUT', 'PATCH'})]
    public function edit(ManagerRegistry $doctrine, Request $request, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $diary = $entityManager->getRepository(Diary::class)->find($id);
   
        if (!$diary) {
            return $this->json('No project found for id' . $id, 404);
        }
         
        $content = json_decode($request->getContent());
        $diary->setTitle($request->request->get('title'));
        $diary->setDate($request->request->get('date'));
        $diary->setType($request->request->get('type'));
        $diary->setDescription($request->request->get('description'));
        $entityManager->flush();
   
        $data =  [
            'id' => $diary->getId(),
            'title' => $diary->getTitle(),
            'date' => $diary->getDate(),
            'type' => $diary->getType(),
            'description' => $diary->getDescription()
        ];
           
        return $this->json($data);
    }

    // #[Route('/back/{id}', name: 'back_edit', methods:{'DELETE'})]
    public function delete(ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $diary = $entityManager->getRepository(Diary::class)->find($id);
   
        if (!$diary) {
            return $this->json('No diary found for id' . $id, 404);
        }
   
        $entityManager->remove($diary);
        $entityManager->flush();
   
        return $this->json('Deleted a diary successfully with id ' . $id);
    }
}
