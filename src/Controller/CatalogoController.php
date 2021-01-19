<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Cabana;
use App\Entity\Categoria;
use App\Entity\Lote;
use App\Entity\Razas;

class CatalogoController extends AbstractController
{


    /**
    * @Route("/",options={"expose"=true}, name="default")
    */
    public function redirectIndex():Response
    {
        return $this->redirect($this->generateUrl('cabanas_index',array('nombre'=>null)));
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

     /**
     * @Route("/lotes/{nombre}",options={"expose"=true}, name="lotes_index")
     */
    public function lotesIndex($nombre=null): Response
    {        
        $search = array('desactivado'=>false);     
        if($nombre!=null)
           $search['nombre']=$nombre;
        $lotes = $this->getDoctrine()->getRepository(Lote::class)->findBy($search);
        $razas = $this->getDoctrine()->getRepository(Razas::class)->findAll();
        $cabanas = $this->getDoctrine()->getRepository(Cabana::class)->findAll();
        $categorias = $this->getDoctrine()->getRepository(Categoria::class)->findAll();


        return $this->render('frontpages/lotes.html.twig', [
            'lotes' => $lotes,
            'razas'=>$razas,
            'cabanas'=>$cabanas,
            'categorias'=>$categorias
        ]);
    }

  
    /**
     * @Route("/lote/{id}", name="lote_detail",options={"expose"=true}, methods={"GET"})
     */
    public function LotesDetail(Lote $lote): Response
    {      
        return $this->render('frontpages/lotedetail.html.twig', [
            'lote' => $lote,
        ]);
    }
}
