<?php

namespace App\Controller;

use App\Entity\CodePostal;
use App\Form\CodePostalType;
use App\Repository\CodePostalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/code/postal")
 */
class CodePostalController extends AbstractController
{
    /**
     * @Route("/", name="code_postal_index", methods={"GET"})
     */
    public function index(CodePostalRepository $codePostalRepository): Response
    {
        return $this->render('code_postal/index.html.twig', [
            'code_postals' => $codePostalRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="code_postal_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $codePostal = new CodePostal();
        $form = $this->createForm(CodePostalType::class, $codePostal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($codePostal);
            $entityManager->flush();

            return $this->redirectToRoute('code_postal_new', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('code_postal/new.html.twig', [
            'code_postal' => $codePostal,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="code_postal_show", methods={"GET"})
     */
    public function show(CodePostal $codePostal): Response
    {
        return $this->render('code_postal/show.html.twig', [
            'code_postal' => $codePostal,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="code_postal_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CodePostal $codePostal): Response
    {
        $form = $this->createForm(CodePostalType::class, $codePostal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('code_postal_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('code_postal/edit.html.twig', [
            'code_postal' => $codePostal,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="code_postal_delete", methods={"POST"})
     */
    public function delete(Request $request, CodePostal $codePostal): Response
    {
        if ($this->isCsrfTokenValid('delete'.$codePostal->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($codePostal);
            $entityManager->flush();
        }

        return $this->redirectToRoute('code_postal_index', [], Response::HTTP_SEE_OTHER);
    }
}
