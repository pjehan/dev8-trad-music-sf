<?php

namespace App\Controller;

use App\Repository\MusicianRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(MusicianRepository $musicianRepository): Response
    {
        // Récupérer la liste des musiciens en base de données (SELECT * FROM musician)
        $musicians = $musicianRepository->findAll();

        // Appel le fichier de template Twig avec la méthode render
        return $this->render('default/homepage.html.twig', [
            'musicians' => $musicians // Permet d'envoyer des données du controller vers la vue (fichier Twig)
        ]);
    }
}
