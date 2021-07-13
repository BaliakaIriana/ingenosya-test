<?php

namespace App\Controller;

use App\Entity\Dirigeant;
use App\Entity\Societe;
use App\Form\DirigeantType;
use App\Form\SocieteType;
use App\Repository\DirigeantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DirigeantController extends AbstractController
{
    /**
     * @Route("/dirigeants", name="dirigeant_index", methods={"GET"})
     */
    public function index(DirigeantRepository $dirigeantRepository): Response
    {
        return $this->render('dirigeant/index.html.twig', [
            'dirigeants' => $dirigeantRepository->findAll(),
        ]);
    }

    /**
     * @Route("/", name="dirigeant_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $dirigeant = new Dirigeant();
        $societe = new Societe();
        $form = $this->createForm(DirigeantType::class, $dirigeant);
        $formsoc = $this->createForm(SocieteType::class, $societe);
        $form->handleRequest($request);
        $formsoc->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($dirigeant);
            $entityManager->flush();

            return $this->redirectToRoute('dirigeant_index', [], Response::HTTP_SEE_OTHER);
        }
        if ($formsoc->isSubmitted() && $formsoc->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($societe);
            $entityManager->flush();

            return $this->redirectToRoute('dirigeant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('dirigeant/new.html.twig', [
            'dirigeant' => $dirigeant,
            'form' => $form,
            'formsoc' => $formsoc,
        ]);
    }

    /**
     * @Route("/dirigeant/{id}", name="dirigeant_show", methods={"GET"})
     */
    public function show(Dirigeant $dirigeant): Response
    {
        return $this->render('dirigeant/show.html.twig', [
            'dirigeant' => $dirigeant,
        ]);
    }

    /**
     * @Route("/dirigeant/{id}/edit", name="dirigeant_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Dirigeant $dirigeant): Response
    {
        $form = $this->createForm(DirigeantType::class, $dirigeant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('dirigeant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('dirigeant/edit.html.twig', [
            'dirigeant' => $dirigeant,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/dirigeant/{id}/delete", name="dirigeant_delete", methods={"POST"})
     */
    public function delete(Request $request, Dirigeant $dirigeant): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dirigeant->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($dirigeant);
            $entityManager->flush();
        }

        return $this->redirectToRoute('dirigeant_index', [], Response::HTTP_SEE_OTHER);
    }
}
