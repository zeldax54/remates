<?php

namespace App\Controller;

use App\Entity\Lote;
use App\Form\LoteType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/lote")
 */
class LoteController extends AbstractController
{
    /**
     * @Route("/", name="lote_index", methods={"GET"})
     */
    public function index(): Response
    {
        $lotes = $this->getDoctrine()
            ->getRepository(Lote::class)
            ->findAll();

        return $this->render('lote/index.html.twig', [
            'lotes' => $lotes,
        ]);
    }

    /**
     * @Route("/new", name="lote_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        
        $lote = new Lote();
        $form = $this->createForm(LoteType::class, $lote);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();        
            $entityManager->persist($lote);
            $entityManager->flush();

            return $this->redirectToRoute('lote_index');
        }

        return $this->render('lote/new.html.twig', [
            'lote' => $lote,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="lote_show", methods={"GET"})
     */
    public function show(Lote $lote): Response
    {
        return $this->render('lote/show.html.twig', [
            'lote' => $lote,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="lote_edit",options={"expose"=true}, methods={"GET","POST"})
     */
    public function edit(Request $request, Lote $lote): Response
    {
        $form = $this->createForm(LoteType::class, $lote);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('lote_index');
        }

        return $this->render('lote/edit.html.twig', [
            'lote' => $lote,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="lote_delete",options={"expose"=true}, methods={"DELETE"})
     */
    public function delete(Request $request, Lote $lote): Response
    {
        if ($this->isCsrfTokenValid('delete'.$lote->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($lote);
            $entityManager->flush();
        }

        return $this->redirectToRoute('lote_index');
    }
}
