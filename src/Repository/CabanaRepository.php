<?php

namespace App\Repository;

use App\Entity\Cabana;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Cabana|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cabana|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cabana[]    findAll()
 * @method Cabana[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CabanaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cabana::class);
    }

    // /**
    //  * @return Cabana[] Returns an array of Cabana objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Cabana
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
