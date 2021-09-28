<?php

namespace App\Controller;

use App\Entity\CabanaEntity;
use App\Repository\CabanaEntityRepository;
use App\Form\CabanaEntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/cabanaentity")
 */
class CabanaEntityController extends AbstractController
{
    /**
     * @Route("/", name="cabana_entity_index", methods={"GET"})
     */
    public function index(CabanaEntityRepository $cabanaEntityRepository): Response
    {
        return $this->render('cabana_entity/index.html.twig', [
            'cabana_entities' => $cabanaEntityRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="cabanaentity_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $cabanaEntity = new CabanaEntity();
        $form = $this->createForm(CabanaEntityType::class, $cabanaEntity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cabanaEntity);
            $entityManager->flush();

            return $this->redirectToRoute('cabana_entity_index');
        }

        return $this->render('cabana_entity/new.html.twig', [
            'cabana_entity' => $cabanaEntity,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cabanaentity_show", methods={"GET"})
     */
    public function show(CabanaEntity $cabanaEntity): Response
    {
        return $this->render('cabana_entity/show.html.twig', [
            'cabana_entity' => $cabanaEntity,
        ]);
    }

    /**
     * @Route("/{id}/edit",options={"expose"=true}, name="cabanaentity_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CabanaEntity $cabanaEntity): Response
    {
        $form = $this->createForm(CabanaEntityType::class, $cabanaEntity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cabana_entity_index');
        }

        return $this->render('cabana_entity/edit.html.twig', [
            'cabana_entity' => $cabanaEntity,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}",options={"expose"=true}, name="cabanaentity_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CabanaEntity $cabanaEntity): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cabanaEntity->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cabanaEntity);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cabana_entity_index');
    }
}
