<?php

namespace App\Controller;

use App\Entity\Pub;
use App\Form\PubType;
use App\Repository\PubRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/pub')]
class PubController extends AbstractController
{
    #[Route('/', name: 'app_pub_index', methods: ['GET'])]
    public function index(PubRepository $pubRepository): Response
    {
        return $this->render('pub/index.html.twig', [
            'pubs' => $pubRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_pub_new', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_MANAGER')]
    public function new(Request $request, PubRepository $pubRepository): Response
    {
        $pub = new Pub();
        $pub->setManager($this->getUser());
        $form = $this->createForm(PubType::class, $pub);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pubRepository->save($pub, true);

            return $this->redirectToRoute('app_pub_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pub/new.html.twig', [
            'pub' => $pub,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_pub_show', methods: ['GET'])]
    public function show(Pub $pub): Response
    {
        return $this->render('pub/show.html.twig', [
            'pub' => $pub,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_pub_edit', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_MANAGER')]
    public function edit(Request $request, Pub $pub, PubRepository $pubRepository): Response
    {
        $form = $this->createForm(PubType::class, $pub);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pubRepository->save($pub, true);

            return $this->redirectToRoute('app_pub_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pub/edit.html.twig', [
            'pub' => $pub,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_pub_delete', methods: ['POST'])]
    #[IsGranted('ROLE_MANAGER')]
    public function delete(Request $request, Pub $pub, PubRepository $pubRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pub->getId(), $request->request->get('_token'))) {
            $pubRepository->remove($pub, true);
        }

        return $this->redirectToRoute('app_pub_index', [], Response::HTTP_SEE_OTHER);
    }
}
