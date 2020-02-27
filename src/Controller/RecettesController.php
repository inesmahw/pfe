<?php

namespace App\Controller;

use App\Entity\Recettes;
use App\Form\RecettesType;
use App\Repository\RecettesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/recettes")
 */
class RecettesController extends AbstractController
{
    /**
     * @Route("/", name="recettes_index", methods={"GET"})
     */
    public function index(RecettesRepository $recettesRepository): Response
    {
        return $this->render('recettes/index.html.twig', [
            'recettes' => $recettesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="recettes_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $recette = new Recettes();
        $form = $this->createForm(RecettesType::class, $recette);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($recette);
            $entityManager->flush();

            return $this->redirectToRoute('recettes_index');
        }

        return $this->render('recettes/new.html.twig', [
            'recette' => $recette,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="recettes_show", methods={"GET"})
     */
    public function show(Recettes $recette): Response
    {
        return $this->render('recettes/show.html.twig', [
            'recette' => $recette,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="recettes_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Recettes $recette): Response
    {
        $form = $this->createForm(RecettesType::class, $recette);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('recettes_index');
        }

        return $this->render('recettes/edit.html.twig', [
            'recette' => $recette,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="recettes_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Recettes $recette): Response
    {
        if ($this->isCsrfTokenValid('delete'.$recette->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($recette);
            $entityManager->flush();
        }

        return $this->redirectToRoute('recettes_index');
    }
}
