<?php

namespace App\Controller;

use App\Entity\Instrument;
use App\Form\InstrumentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InstrumentController extends AbstractController
{
    #[Route('/instrument/new', name: 'instrument_new')]
    public function new(): Response
    {
        // Créer un nouvel instrument
        $instrument = new Instrument();

        // Créer un formulaire pour notre nouvel instrument
        $form = $this->createForm(InstrumentType::class, $instrument);

        return $this->renderForm('instrument/new.html.twig', [
            'form' => $form,
        ]);
    }
}
