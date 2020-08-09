<?php

namespace App\Repository;

use App\Entity\PrixAuteur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PrixAuteur|null find($id, $lockMode = null, $lockVersion = null)
 * @method PrixAuteur|null findOneBy(array $criteria, array $orderBy = null)
 * @method PrixAuteur[]    findAll()
 * @method PrixAuteur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrixAuteurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PrixAuteur::class);
    }

    // /**
    //  * @return PrixAuteur[] Returns an array of PrixAuteur objects
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
    public function findOneBySomeField($value): ?PrixAuteur
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
