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
     * @Route("/generictable", name="generictable")
     */
    public function getData(Request $request): Response
    {
        $entityName = $request->request->get('entityName');
        $columnsName = $request->request->get('columnsName');
        $current = $request->request->get('current');
        $searchPhrase = $request->request->get('searchPhrase');
        $rowCount = $request->request->get('rowCount');
        $sort = $request->request->get('sort');
        $offset = 0;
        $query = $this->filtrar($entityName,$searchPhrase,$columnsName,$sort);
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

    private function filtrar($entityName,$searchPhrase,$columnNames,$sort) {
        $qb = new QueryBuilder($this->getDoctrine()->getManager());
        $qb
            ->select("E")
            ->from("App:".$entityName, "E");

        if ($searchPhrase != null) {      
            foreach($columnNames as $column) {          
                $qb->where($qb->expr()->like("E.".$column, $qb->expr()->literal("%" . $searchPhrase . "%")));
            }                   
        }
        if ($sort != null) {            
            foreach ($sort as $key => $value) 
                $qb->orderBy("E." . $key, $value);            
        }
        return $qb->getQuery();
    }
}
