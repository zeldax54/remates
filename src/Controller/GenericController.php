<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Component\HttpFoundation\JsonResponse;


class GenericController extends AbstractController
{
    /**
     * @Route("/admin/generictable", name="generictable")
     */
    public function getData(Request $request): Response
    {
        date_default_timezone_set("America/Argentina/Buenos_Aires");
        $entityName = $request->request->get('entityName');
        $columnsName = $request->request->get('columnsName');
        $current = $request->request->get('current');
        $searchPhrase = $request->request->get('searchPhrase');
        $rowCount = $request->request->get('rowCount');
        $sort = $request->request->get('sort');
        $parentEntity = $request->request->get('parentEntity');     
        $offset = 0;
        $query = $this->filtrar($entityName,$searchPhrase,$columnsName,$sort,$parentEntity);
        $paginator = new Paginator($query, $fetchJoinCollection = true);
        $total = $paginator->count();
        
        if ($rowCount >= 0 && $current > 0) {
            $offset = ($current - 1) * $rowCount;
            if ($offset > $total || $offset < 0) {
                $current = 1;
                $offset = 0;
            }
            $query
                    ->setFirstResult($offset)
                    ->setMaxResults($rowCount);
        }       
        $entities = $query->getArrayResult();      
       
        $result = array(
            "current" => intval($current),
            "rowCount" => intval($rowCount),
            "rows" => $entities,
            "total" => $rowCount
        );
        return new JsonResponse($result);
    }

    private function filtrar($entityName,$searchPhrase,$columnNames,$sort,$parentEntity) {
        $qb = new QueryBuilder($this->getDoctrine()->getManager());

        if($parentEntity!=null){
            $qb->select("E","P")
            ->from("App:".$entityName, "E")
            ->leftJoin("E.". $parentEntity, "P");
        }else{
            $qb
            ->select("E")
            ->from("App:".$entityName, "E");
        }         

        if ($searchPhrase != null) {      
            foreach($columnNames as $column)         
                $qb->where($qb->expr()->like("E.".$column, $qb->expr()->literal("%" . $searchPhrase . "%")));
                
            if($parentEntity!=null)
                $qb->where($qb->expr()->like("P.nombre", $qb->expr()->literal("%" . $searchPhrase . "%")));                              
        }
        if ($sort != null) {            
            foreach ($sort as $key => $value) 
                $qb->orderBy("E." . $key, $value);            
        }
        else
          $qb->orderBy("E.id",'DESC');            
        return $qb->getQuery();
    }


    public function filterLotes(Request $request)
    {
        $raza = $request->request->get('raza');
        $categoria = $request->request->get('categoria');
        $cabana = $request->request->get('cabana');

        $qb = new QueryBuilder($this->getDoctrine()->getManager());
        $qb
        ->select("L","T","R","C")
        ->from("App:Lote", "L") 
        ->leftJoin("L.raza", "R")
        ->leftJoin("L.toros", "T")
        ->leftJoin("L.cabana", "C")
        ->leftJoin("L.categoria", "Ca");

        if($raza!=-1)
            $qb->andWhere("R.id=".$raza);
        if($categoria!=-1)
            $qb->andWhere("Ca.id=".$categoria);
        if($cabana!=-1)
            $qb->andWhere("C.id=".$cabana);           
        $result = $qb->getQuery()->getArrayResult();  
        return new JsonResponse($result);
        
    }
}
