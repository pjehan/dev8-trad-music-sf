<?php

namespace App\Controller;

use App\Repository\MusicianRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MusicianController extends AbstractController
{
    #[Route('/musician', name: 'musician_list')]
    public function list(MusicianRepository $musicianRepository): Response
    {
        return $this->render('musician/index.html.twig', [
            'musicians' => $musicianRepository->findAll(),
        ]);
    }

    #[Route('/musician/{id}', name: 'musician_detail', requirements: ['id' => '\d+'])]
    public function detail(int $id, MusicianRepository $musicianRepository): Response
    {
        $musician = $musicianRepository->find($id);

        // Si le musicien n'existe pas en base de données on retourne une erreur 404
        if ($musician === null) {
            throw $this->createNotFoundException();
        }

        return $this->render('musician/detail.html.twig', ['musician' => $musician]);
    }
}
