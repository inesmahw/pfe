<?php

namespace App\Repository;

use App\Entity\Astuces;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Astuces|null find($id, $lockMode = null, $lockVersion = null)
 * @method Astuces|null findOneBy(array $criteria, array $orderBy = null)
 * @method Astuces[]    findAll()
 * @method Astuces[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AstucesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Astuces::class);
    }

    // /**
    //  * @return Astuces[] Returns an array of Astuces objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Astuces
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
