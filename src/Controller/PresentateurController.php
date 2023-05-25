<?php
namespace App\Controller;

use App\Entity\Presentateur;
use App\Form\PresentateurType;
use App\Repository\PresentateurRepository;
use App\Repository\RoleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

//use Doctrine\ORM\EntityManagerInterface;



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
    public function new(Request $request, PresentateurRepository $presentateurRepository, RoleRepository $roleRepository, EntityManagerInterface $entityManager): Response
    {
        $presentateur = new Presentateur();
        $form = $this->createForm(PresentateurType::class, $presentateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $roleId = $request->request->get('presentateur')['role'];
            $role = $roleRepository->find($roleId);
            $presentateur->setRole($role);

            // Persist the Presentateur entity
            $entityManager->persist($presentateur);
            $entityManager->persist($role); // Persist the Role entity
            $entityManager->flush();

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
    public function edit(Request $request, Presentateur $presentateur, PresentateurRepository $presentateurRepository, RoleRepository $roleRepository): Response
    {
        $form = $this->createForm(PresentateurType::class, $presentateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $role = $roleRepository->find($request->request->get('presentateur')['role']);
            $presentateur->setRole($role);
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
