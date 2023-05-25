<?php

namespace App\Controller;

use App\Entity\Presentateur;
use App\Form\PresentateurType;
use App\Repository\PresentateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/presentateur')]
class PresentateurController extends AbstractController
{
    #[Route('/', name: 'app_presentateur_index', methods: ['GET'])]
    public function index(PresentateurRepository $presentateurRepository): Response
    {
        return $this->render('presentateur/index.html.twig', [
            'presentateurs' => $presentateurRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_presentateur_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PresentateurRepository $presentateurRepository): Response
    {
        $presentateur = new Presentateur();
        $form = $this->createForm(PresentateurType::class, $presentateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $presentateurRepository->save($presentateur, true);

            return $this->redirectToRoute('app_presentateur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('presentateur/new.html.twig', [
            'presentateur' => $presentateur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_presentateur_show', methods: ['GET'])]
    public function show(Presentateur $presentateur): Response
    {
        return $this->render('presentateur/show.html.twig', [
            'presentateur' => $presentateur,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_presentateur_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Presentateur $presentateur, PresentateurRepository $presentateurRepository): Response
    {
        $form = $this->createForm(PresentateurType::class, $presentateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $presentateurRepository->save($presentateur, true);

            return $this->redirectToRoute('app_presentateur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('presentateur/edit.html.twig', [
            'presentateur' => $presentateur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_presentateur_delete', methods: ['POST'])]
    public function delete(Request $request, Presentateur $presentateur, PresentateurRepository $presentateurRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$presentateur->getId(), $request->request->get('_token'))) {
            $presentateurRepository->remove($presentateur, true);
        }

        return $this->redirectToRoute('app_presentateur_index', [], Response::HTTP_SEE_OTHER);
    }
}
