<?php

namespace App\Repository;

use App\Entity\Prono;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Prono|null find($id, $lockMode = null, $lockVersion = null)
 * @method Prono|null findOneBy(array $criteria, array $orderBy = null)
 * @method Prono[]    findAll()
 * @method Prono[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PronoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Prono::class);
    }

    // /**
    //  * @return Prono[] Returns an array of Prono objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Prono
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
