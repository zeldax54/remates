<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CatalogoController extends AbstractController
{


    /**
    * @Route("/",options={"expose"=true}, name="default")
    */
    public function redirectIndex():Response
    {
        return $this->redirect($this->generateUrl('cabanas_index'));
    }

    /**
     * @Route("/cabanas", name="cabanas_index")
     */
    public function cabanasIndex(): Response
    {
        return $this->render('frontpages/cabanas.html.twig', [
            'controller_name' => 'CatalogoController',
        ]);
    }
}
