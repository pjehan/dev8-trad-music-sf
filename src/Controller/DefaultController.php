<?php

namespace App\Controller;

use App\Repository\InstrumentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(InstrumentRepository $instrumentRepository): Response
    {
        // Récupérer la liste des instruments en base de données (SELECT * FROM instrument)
        $instruments = $instrumentRepository->findAll();

        // Appel le fichier de template Twig avec la méthode render
        return $this->render('default/homepage.html.twig', [
            'instruments' => $instruments // Permet d'envoyer des données du controller vers la vue (fichier Twig)
        ]);
    }
}
