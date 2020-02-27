<?php

namespace App\Controller;

use App\Entity\Astuces;
use App\Form\AstucesType;
use App\Repository\AstucesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/astuces")
 */
class AstucesController extends AbstractController
{
    /**
     * @Route("/", name="astuces_index", methods={"GET"})
     */
    public function index(AstucesRepository $astucesRepository): Response
    {
        return $this->render('astuces/index.html.twig', [
            'astuces' => $astucesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="astuces_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $astuce = new Astuces();
        $form = $this->createForm(AstucesType::class, $astuce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($astuce);
            $entityManager->flush();

            return $this->redirectToRoute('astuces_index');
        }

        return $this->render('astuces/new.html.twig', [
            'astuce' => $astuce,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="astuces_show", methods={"GET"})
     */
    public function show(Astuces $astuce): Response
    {
        return $this->render('astuces/show.html.twig', [
            'astuce' => $astuce,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="astuces_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Astuces $astuce): Response
    {
        $form = $this->createForm(AstucesType::class, $astuce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('astuces_index');
        }

        return $this->render('astuces/edit.html.twig', [
            'astuce' => $astuce,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="astuces_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Astuces $astuce): Response
    {
        if ($this->isCsrfTokenValid('delete'.$astuce->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($astuce);
            $entityManager->flush();
        }

        return $this->redirectToRoute('astuces_index');
    }
}
