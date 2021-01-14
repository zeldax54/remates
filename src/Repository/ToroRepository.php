<?php

namespace App\Repository;

use App\Entity\Toro;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Toro|null find($id, $lockMode = null, $lockVersion = null)
 * @method Toro|null findOneBy(array $criteria, array $orderBy = null)
 * @method Toro[]    findAll()
 * @method Toro[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ToroRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Toro::class);
    }

    // /**
    //  * @return Toro[] Returns an array of Toro objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Toro
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
