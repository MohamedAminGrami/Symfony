<?php

namespace App\Controller;

use App\Entity\Numero;
use App\Form\NumeroType;
use App\Repository\NumeroRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/numero')]
class NumeroController extends AbstractController
{
    #[Route('/', name: 'app_numero_index', methods: ['GET'])]
    public function index(NumeroRepository $numeroRepository): Response
    {
        return $this->render('numero/index.html.twig', [
            'numeros' => $numeroRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_numero_new', methods: ['GET', 'POST'])]
    public function new(Request $request, NumeroRepository $numeroRepository): Response
    {
        $numero = new Numero();
        $form = $this->createForm(NumeroType::class, $numero);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $numeroRepository->save($numero, true);

            return $this->redirectToRoute('app_numero_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('numero/new.html.twig', [
            'numero' => $numero,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_numero_show', methods: ['GET'])]
    public function show(Numero $numero): Response
    {
        return $this->render('numero/show.html.twig', [
            'numero' => $numero,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_numero_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Numero $numero, NumeroRepository $numeroRepository): Response
    {
        $form = $this->createForm(NumeroType::class, $numero);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $numeroRepository->save($numero, true);

            return $this->redirectToRoute('app_numero_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('numero/edit.html.twig', [
            'numero' => $numero,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_numero_delete', methods: ['POST'])]
    public function delete(Request $request, Numero $numero, NumeroRepository $numeroRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$numero->getId(), $request->request->get('_token'))) {
            $numeroRepository->remove($numero, true);
        }

        return $this->redirectToRoute('app_numero_index', [], Response::HTTP_SEE_OTHER);
    }
}
