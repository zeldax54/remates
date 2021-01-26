<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\QueryBuilder;

class ReporteController extends AbstractController
{
      /**
     * @Route("admin/reporte", name="reporte_index",options={"expose"=true}, methods={"GET"})
     */
    public function reporteIndex(): Response
    {         

        return $this->render('admin/reporte.html.twig', [
           
        ]);
    }

      /**
     * @Route("admin/reporterender", name="reporte_render",options={"expose"=true}, methods={"POST"})
     */
    public function reporteRender(Request $request): Response
    {     
        $fechaInicio = $request->request->get('fechainicio');
        $fechafin = $request->request->get('fechafin');
        $qb = new QueryBuilder($this->getDoctrine()->getManager());
        $qb->select("O")
            ->from("App:Oferta", "O")
            ->where("O.fecha >=" . $fechaInicio)
            ->andWhere("O.fecha <=" . $fechafin)         
            ->orderBy('O.id', 'DESC')->setMaxResults(1);       
         $ofertas = $qb->getQuery()->getArrayResult();
         foreach($ofertas as $f){
             
         }

        
        print_r( $fechaInicio );
        print('reportito');die();

        return $this->render('admin/reporte.html.twig', [
           
        ]);
    }
}
