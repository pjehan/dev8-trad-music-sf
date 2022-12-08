<?php

namespace App\Controller;

use App\Entity\Instrument;
use App\Form\InstrumentType;
use App\Repository\InstrumentRepository;
use Doctrine\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InstrumentController extends AbstractController
{
    #[Route('/instrument/new', name: 'instrument_new')]
    #[IsGranted('ROLE_ADMIN')]
    public function new(Request $request, ManagerRegistry $doctrine): Response
    {
        // Créer un nouvel instrument
        $instrument = new Instrument();

        // Créer un formulaire pour notre nouvel instrument
        $form = $this->createForm(InstrumentType::class, $instrument);

        // On récupère les données du formulaire pour les mettre dans l'entité ($instrument)
        $form->handleRequest($request);

        // On vérifie que le formulaire est envoyé et que les données sont valides
        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérer l'entity manager de Doctrine
            $entityManager = $doctrine->getManager();

            // Enregistrer les données en base de données
            $entityManager->persist($instrument);
            $entityManager->flush();

            // Rediriger l'internaute vers la page d'accueil
            return $this->redirectToRoute('homepage');
        }

        return $this->renderForm('instrument/new.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/instrument/{id}', name: 'app_instrument_show', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function show(Instrument $instrument): Response
    {
        return $this->render('instrument/show.html.twig', ['instrument' => $instrument]);
    }

    /**
     * Méthode qui permet d'afficher la liste des instruments.
     * Cette méthode sera appelée en Twig avec render(controller())
     */
    public function listInstruments(InstrumentRepository $instrumentRepository): Response
    {
        $instruments = $instrumentRepository->findBy([], ['name' => 'ASC']); // SELECT * FROM instrument ORDER BY name ASC;

        return $this->render('instrument/_list.html.twig', [
            'instruments' => $instruments
        ]);
    }
}
