<?php

namespace App\Controller;

use App\Entity\Societe;
use App\Form\Societe1Type;
use App\Form\SocieteType;
use App\Repository\SocieteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/societe")
 */
class SocieteController extends AbstractController
{
    /**
     * @Route("/", name="societe_index", methods={"GET"})
     */
    public function index(SocieteRepository $societeRepository): Response
    {
        return $this->render('societe/index.html.twig', [
            'societes' => $societeRepository->findAll(),
        ]);
    }
//
//    /**
//     * @Route("/new", name="societe_new", methods={"GET","POST"})
//     */
//    public function new(Request $request): Response
//    {
//        $societe = new Societe();
//        $form = $this->createForm(Societe1Type::class, $societe);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $entityManager = $this->getDoctrine()->getManager();
//            $entityManager->persist($societe);
//            $entityManager->flush();
//
//            return $this->redirectToRoute('societe_index', [], Response::HTTP_SEE_OTHER);
//        }
//
//        return $this->renderForm('societe/new.html.twig', [
//            'societe' => $societe,
//            'form' => $form,
//        ]);
//    }

    /**
     * @Route("/{id}", name="societe_show", methods={"GET"})
     */
    public function show(Societe $societe): Response
    {
        return $this->render('societe/show.html.twig', [
            'societe' => $societe,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="societe_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Societe $societe): Response
    {
        $societe->setPostal($societe->getVille()->getCodePostal());
        $form = $this->createForm(SocieteType::class, $societe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('societe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('societe/edit.html.twig', [
            'societe' => $societe,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="societe_delete", methods={"POST"})
     */
    public function delete(Request $request, Societe $societe): Response
    {
        if ($this->isCsrfTokenValid('delete'.$societe->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($societe);
            $entityManager->flush();
        }

        return $this->redirectToRoute('societe_index', [], Response::HTTP_SEE_OTHER);
    }
}
