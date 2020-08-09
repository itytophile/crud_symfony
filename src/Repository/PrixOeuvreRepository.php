<?php

namespace App\Repository;

use App\Entity\PrixOeuvre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PrixOeuvre|null find($id, $lockMode = null, $lockVersion = null)
 * @method PrixOeuvre|null findOneBy(array $criteria, array $orderBy = null)
 * @method PrixOeuvre[]    findAll()
 * @method PrixOeuvre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrixOeuvreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PrixOeuvre::class);
    }

    // /**
    //  * @return PrixOeuvre[] Returns an array of PrixOeuvre objects
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
    public function findOneBySomeField($value): ?PrixOeuvre
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
