<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Cabana;

class CatalogoController extends AbstractController
{


    /**
    * @Route("/",options={"expose"=true}, name="default")
    */
    public function redirectIndex():Response
    {
        return $this->redirect($this->generateUrl('cabanas_index',array('nombre'=>54)));
    }

    /**
     * @Route("/cabanas/{nombre}",options={"expose"=true}, name="cabanas_index")
     */
    public function cabanasIndex($nombre=null): Response
    {        
        $search = array('desactivado'=>false);     
        if($nombre!=null)
           $search['nombre']=$nombre;
        $cabanas = $this->getDoctrine()->getRepository(Cabana::class)->findBy($search);
        return $this->render('frontpages/cabanas.html.twig', [

            'cabanas' => $cabanas,
        ]);
    }

     /**
     * @Route("/cabana/{id}", name="cabana_detail",options={"expose"=true}, methods={"GET"})
     */
    public function cabanaDetail(Cabana $cabana): Response
    {        

  
        return $this->render('frontpages/cabanadetail.html.twig', [
            'cabana' => $cabana,
        ]);
    }
}
