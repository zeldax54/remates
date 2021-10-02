<?php

namespace App\Controller;

use App\Entity\Toro;
use App\Form\ToroType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/toro")
 */
class ToroController extends AbstractController
{
    /**
     * @Route("/", name="toro_index", methods={"GET"})
     */
    public function index(): Response
    {
        $toros = $this->getDoctrine()
            ->getRepository(Toro::class)
            ->findAll();

        return $this->render('toro/index.html.twig', [
            'toros' => $toros,
        ]);
    }

    /**
     * @Route("/new", name="toro_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $toro = new Toro();
        $form = $this->createForm(ToroType::class, $toro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();      
            $toro->setOfertaActual(0);      
            $entityManager->persist($toro);
            $entityManager->flush();

            return $this->redirectToRoute('toro_index');
        }

        return $this->render('toro/new.html.twig', [
            'toro' => $toro,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="toro_show", methods={"GET"})
     */
    public function show(Toro $toro): Response
    {
        return $this->render('toro/show.html.twig', [
            'toro' => $toro,
        ]);
    }

    /**
     * @Route("/{id}/edit",options={"expose"=true}, name="toro_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Toro $toro): Response
    {
        $form = $this->createForm(ToroType::class, $toro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('toro_index');
        }

        return $this->render('toro/edit.html.twig', [
            'toro' => $toro,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}",options={"expose"=true}, name="toro_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Toro $toro): Response
    {
        if ($this->isCsrfTokenValid('delete'.$toro->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($toro);
            $entityManager->flush();
        }

        return $this->redirectToRoute('toro_index');
    }
}
