<?php

namespace App\Controller;

use App\Entity\Traversee;
use App\Form\TraverseeType;
use App\Repository\TraverseeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/traverseeclient')]
class TraverseeClientController extends AbstractController
{
    #[Route('/', name: 'app_traversee_client_index', methods: ['GET'])]
    public function index(TraverseeRepository $traverseeRepository): Response
    {
        return $this->render('traversee_client/index.html.twig', [
            'traversees' => $traverseeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_traversee_client_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TraverseeRepository $traverseeRepository): Response
    {
        $traversee = new Traversee();
        $form = $this->createForm(TraverseeType::class, $traversee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $traverseeRepository->save($traversee, true);

            return $this->redirectToRoute('app_traversee_client_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('traversee_client/new.html.twig', [
            'traversee' => $traversee,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_traversee_client_show', methods: ['GET'])]
    public function show(Traversee $traversee): Response
    {
        return $this->render('traversee_client/show.html.twig', [
            'traversee' => $traversee,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_traversee_client_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Traversee $traversee, TraverseeRepository $traverseeRepository): Response
    {
        $form = $this->createForm(TraverseeType::class, $traversee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $traverseeRepository->save($traversee, true);

            return $this->redirectToRoute('app_traversee_client_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('traversee_client/edit.html.twig', [
            'traversee' => $traversee,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_traversee_client_delete', methods: ['POST'])]
    public function delete(Request $request, Traversee $traversee, TraverseeRepository $traverseeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$traversee->getId(), $request->request->get('_token'))) {
            $traverseeRepository->remove($traversee, true);
        }

        return $this->redirectToRoute('app_traversee_client_index', [], Response::HTTP_SEE_OTHER);
    }
}
