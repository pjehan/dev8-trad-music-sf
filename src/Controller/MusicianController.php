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

    #[Route('/musician/{id}', name: 'musician_detail')]
    public function detail(int $id, MusicianRepository $musicianRepository): Response
    {
        $musician = $musicianRepository->find($id);
        return $this->render('musician/detail.html.twig', ['musician' => $musician]);
    }
}
