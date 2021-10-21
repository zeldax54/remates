<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\QueryBuilder;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Cabana;
use DateTime;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class ReporteController extends AbstractController
{
    /**
     * @Route("admin/reporte", name="reporte_index",options={"expose"=true}, methods={"GET"})
     */
    public function reporteIndex(): Response
    {
        $reporturl = $this->generateUrl('reporte_render', array(),
             UrlGeneratorInterface::ABSOLUTE_URL);

        return $this->render('admin/reporte.html.twig', array(
       'reportUrl'=>$reporturl
        ));
    }

    /**
     * @Route("admin/reporterender", name="reporte_render",options={"expose"=true}, methods={"POST"})
     */
    public function reporteRender(Request $request): Response
    {
        $fechaInicio = $request->request->get('fechainicio');
        $fechafin = $request->request->get('fechafin');
        $agrupar = strtolower($request->request->get('agrupar')) === 'yes';
      
        $cabanas = $this->getDoctrine()->getRepository(Cabana::class)->findAll();

        $sheetIter = 0;
        $objPHPExcel = new \PHPExcel();
       
        foreach ($cabanas as $cabana) 
        {           

            $qb = new QueryBuilder($this->getDoctrine()->getManager());
            $qb->select("O","C","L","T")
            ->from("App:Oferta", "O")
            ->leftJoin("O.lote","L")
             ->leftJoin("O.toro","T")
            ->leftJoin("L.cabana","C")
            ->where("O.fecha >='" . $fechaInicio . "'")
            ->andWhere("O.fecha <='" . $fechafin . "'")
            ->andWhere("C.id ='" . $cabana->getId(). "'");     
               
                     
               $qb->orderBy('T.nombre') ->addOrderBy('O.fecha', 'DESC'); 
            
                

           

            $ofertas = $qb->getQuery()->getArrayResult();
          //  print(count($ofertas));
         
            if(count($ofertas)>0)
            {
            $objWorkSheet = $objPHPExcel->createSheet($sheetIter);
            $objPHPExcel->setActiveSheetIndex($sheetIter);
            $objPHPExcel->getActiveSheet()->setTitle(substr($cabana->getNombre(),0,30));
            //Write cells

            $objWorkSheet
                 ->setCellValue('A1', 'Lote')
                 ->setCellValue('B1', 'Toro')
                 ->setCellValue('C1', 'Nombre')
                 ->setCellValue('D1', 'Empresa')
                 ->setCellValue('E1', 'DNI/CUIT')
                 ->setCellValue('F1', 'Email')
                 ->setCellValue('G1', 'Telefono')
                 ->setCellValue('H1', 'Estado')
                 ->setCellValue('I1', 'Fecha')
                 ->setCellValue('J1', 'Cantidad Ofertada');
                 $this->Colorear( $objPHPExcel,array('A','B','C','D','E','F','G','H','I','J'),1);

                 $inneriter = 2;
                 foreach($ofertas as $o){      
             
                    $status ='';
                  switch ($o['status']) {
                      case 'S':
                        $status = 'Superada';
                      break;   

                      case 'A':
                        $status = 'Aceptada';
                      break;     

                      case 'R':
                        $status = 'Rechazada';
                      break;                        
                  }

                  $objWorkSheet ->setCellValue('A'.$inneriter, $o['lote']['nombre']);
                  $objWorkSheet ->setCellValue('B'.$inneriter, $o['toro']['nombre']);
                  $objWorkSheet ->setCellValue('C'.$inneriter, $o['nombre']);
                  $objWorkSheet ->setCellValue('D'.$inneriter, $o['empresa']);
                  $objWorkSheet ->setCellValue('E'.$inneriter, $o['dnicuit']);
                  $objWorkSheet ->setCellValue('F'.$inneriter, $o['email']);
                  $objWorkSheet ->setCellValue('G'.$inneriter, $o['telefono']);
                  $objWorkSheet ->setCellValue('H'.$inneriter, $status);
                  $objWorkSheet ->setCellValue('I'.$inneriter, $o['fecha']->format('d-m-Y H:i:s'));
                  $objWorkSheet ->setCellValue('J'.$inneriter, $o['ofertado']);
                
                  if($agrupar == true && $inneriter > 2 && $o['toro']['id']!= $ofertas[$inneriter-2-1]['toro']['id'] )
                  {
                    $objWorkSheet ->setCellValue('A'.$inneriter, '');
                    $objWorkSheet ->setCellValue('B'.$inneriter, '');
                    $objWorkSheet ->setCellValue('C'.$inneriter, '');
                    $objWorkSheet ->setCellValue('D'.$inneriter, '');
                    $objWorkSheet ->setCellValue('E'.$inneriter, '');
                    $objWorkSheet ->setCellValue('F'.$inneriter, '');
                    $objWorkSheet ->setCellValue('G'.$inneriter, '');
                    $objWorkSheet ->setCellValue('H'.$inneriter, '');
                    $objWorkSheet ->setCellValue('I'.$inneriter, '');
                    $objWorkSheet ->setCellValue('J'.$inneriter, '');
                  }
                 
                  $inneriter++;

                 }          
                

                $sheetIter++;
            }
          
        }
      

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');


        header('Content-Disposition: attachment;filename="reporte.xlsx"');
        
        header('Cache-Control: max-age=0');
        
        
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        
        if (ob_get_length()) ob_end_clean();
        $objWriter->save('php://output');
        
        
        exit;
    }






   function getNext($numero){
        $iter=0;
        for($x = 'A'; $x < 'ZZ'; $x++)
        {
            if($numero==$iter)
                return $x;
            $iter++;
        }
           return null;
    }



    function random_color_part()
    {
        return str_pad(dechex(mt_rand(150, 255)), 2, '0', STR_PAD_LEFT);
    }

    function rand_color()
    {
        return $this->random_color_part() . $this->random_color_part() . $this->random_color_part();
    }

    function SetBold($objPHPExcel, $columnas, $rownumber)
    {
        $style = array(
            'alignment' => array(
                'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );

        foreach ($columnas as $l) {
            $objPHPExcel->getActiveSheet()->getStyle($l . $rownumber)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle($l . $rownumber)->applyFromArray($style);
        }
    }
    function Colorear($objPHPExcel, $columnas, $rownumber)
    {
        $color = $this->rand_color();
        foreach ($columnas as $c) {
            $objPHPExcel->getActiveSheet()->getStyle($c . $rownumber)->getFill()->applyFromArray(array(
                'type' => \PHPExcel_Style_Fill::FILL_SOLID,
                'startcolor' => array(
                    'rgb' => $color
                )
            ));
        }
    }

    function ColorearSingle($objPHPExcel, $columna, $rownumber, $color)
    {
        $style = array(
            'alignment' => array(
                'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle($columna . $rownumber)->getFill()->applyFromArray(array(
            'type' => \PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array(
                'rgb' => $color
            )
        ));
        $objPHPExcel->getActiveSheet()->getStyle($columna . $rownumber)->applyFromArray($style);
    }

    function centerCell($objPHPExcel, $columna, $rownumber)
    {
        $style = array(
            'alignment' => array(
                'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle($columna . $rownumber)->applyFromArray($style);
    }
}
