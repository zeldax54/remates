<?php

namespace App\Repository;

use App\Entity\CabanaEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CabanaEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method CabanaEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method CabanaEntity[]    findAll()
 * @method CabanaEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CabanaEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CabanaEntity::class);
    }

    // /**
    //  * @return CabanaEntity[] Returns an array of CabanaEntity objects
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
    public function findOneBySomeField($value): ?CabanaEntity
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
