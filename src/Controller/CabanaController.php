<?php

namespace App\Controller;

use App\Entity\Cabana;
use App\Form\CabanaType;
use App\Repository\CabanaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/cabana")
 */
class CabanaController extends AbstractController
{
    /**
     * @Route("/", name="cabana_index", methods={"GET"})
     */
    public function index(CabanaRepository $cabanaRepository): Response
    {
        return $this->render('cabana/index.html.twig', [
            'cabanas' => $cabanaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="cabana_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $cabana = new Cabana();
        $form = $this->createForm(CabanaType::class, $cabana);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cabana);
            $entityManager->flush();

            return $this->redirectToRoute('cabana_index');
        }

        return $this->render('cabana/new.html.twig', [
            'cabana' => $cabana,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cabana_show", methods={"GET"})
     */
    public function show(Cabana $cabana): Response
    {
        return $this->render('cabana/show.html.twig', [
            'cabana' => $cabana,
        ]);
    }

    /**
     * @Route("/{id}/edit",options={"expose"=true}, name="cabana_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Cabana $cabana): Response
    {
        $form = $this->createForm(CabanaType::class, $cabana);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cabana_index');
        }

        return $this->render('cabana/edit.html.twig', [
            'cabana' => $cabana,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}",options={"expose"=true}, name="cabana_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Cabana $cabana): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cabana->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cabana);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cabana_index');
    }
}
