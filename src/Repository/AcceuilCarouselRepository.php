<?php

namespace App\Repository;

use App\Entity\AcceuilCarousel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AcceuilCarousel|null find($id, $lockMode = null, $lockVersion = null)
 * @method AcceuilCarousel|null findOneBy(array $criteria, array $orderBy = null)
 * @method AcceuilCarousel[]    findAll()
 * @method AcceuilCarousel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AcceuilCarouselRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AcceuilCarousel::class);
    }

    // /**
    //  * @return AcceuilCarousel[] Returns an array of AcceuilCarousel objects
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
    public function findOneBySomeField($value): ?AcceuilCarousel
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
