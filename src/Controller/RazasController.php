<?php

namespace App\Controller;

use App\Entity\Razas;
use App\Form\RazasType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/razas")
 */
class RazasController extends AbstractController
{
    /**
     * @Route("/", name="razas_index", methods={"GET"})
     */
    public function index(): Response
    {
        $razas = $this->getDoctrine()
            ->getRepository(Razas::class)
            ->findAll();

        return $this->render('razas/index.html.twig', [
            'razas' => $razas,
        ]);
    }

    /**
     * @Route("/new", name="razas_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $raza = new Razas();
        $form = $this->createForm(RazasType::class, $raza);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($raza);
            $entityManager->flush();

            return $this->redirectToRoute('razas_index');
        }

        return $this->render('razas/new.html.twig', [
            'raza' => $raza,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="razas_show", methods={"GET"})
     */
    public function show(Razas $raza): Response
    {
        return $this->render('razas/show.html.twig', [
            'raza' => $raza,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="razas_edit",options={"expose"=true}, methods={"GET","POST"})
     */
    public function edit(Request $request, Razas $raza): Response
    {
        $form = $this->createForm(RazasType::class, $raza);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('razas_index');
        }

        return $this->render('razas/edit.html.twig', [
            'raza' => $raza,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="razas_delete",options={"expose"=true}, methods={"DELETE"})
     */
    public function delete(Request $request, Razas $raza): Response
    {
        if ($this->isCsrfTokenValid('delete'.$raza->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($raza);
            $entityManager->flush();
        }

        return $this->redirectToRoute('razas_index');
    }
}
