<?php

namespace App\Repository;

use App\Entity\TypeSociety;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypeSociety|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeSociety|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeSociety[]    findAll()
 * @method TypeSociety[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeSocietyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeSociety::class);
    }

    // /**
    //  * @return TypeSociety[] Returns an array of TypeSociety objects
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
    public function findOneBySomeField($value): ?TypeSociety
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
