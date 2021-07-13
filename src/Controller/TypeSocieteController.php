<?php

namespace App\Controller;

use App\Entity\TypeSociete;
use App\Form\TypeSocieteType;
use App\Repository\TypeSocieteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/type/societe")
 */
class TypeSocieteController extends AbstractController
{
    /**
     * @Route("/", name="type_societe_index", methods={"GET"})
     */
    public function index(TypeSocieteRepository $typeSocieteRepository): Response
    {
        return $this->render('type_societe/index.html.twig', [
            'type_societes' => $typeSocieteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="type_societe_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $typeSociete = new TypeSociete();
        $form = $this->createForm(TypeSocieteType::class, $typeSociete);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($typeSociete);
            $entityManager->flush();

            return $this->redirectToRoute('type_societe_new', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('type_societe/new.html.twig', [
            'type_societe' => $typeSociete,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="type_societe_show", methods={"GET"})
     */
    public function show(TypeSociete $typeSociete): Response
    {
        return $this->render('type_societe/show.html.twig', [
            'type_societe' => $typeSociete,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="type_societe_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TypeSociete $typeSociete): Response
    {
        $form = $this->createForm(TypeSocieteType::class, $typeSociete);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('type_societe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('type_societe/edit.html.twig', [
            'type_societe' => $typeSociete,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="type_societe_delete", methods={"POST"})
     */
    public function delete(Request $request, TypeSociete $typeSociete): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeSociete->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($typeSociete);
            $entityManager->flush();
        }

        return $this->redirectToRoute('type_societe_index', [], Response::HTTP_SEE_OTHER);
    }
}
