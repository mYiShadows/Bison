<?php

namespace App\Repository;

use App\Entity\ImageShowProjet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ImageShowProjet|null find($id, $lockMode = null, $lockVersion = null)
 * @method ImageShowProjet|null findOneBy(array $criteria, array $orderBy = null)
 * @method ImageShowProjet[]    findAll()
 * @method ImageShowProjet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImageShowProjetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ImageShowProjet::class);
    }

    // /**
    //  * @return ImageShowProjet[] Returns an array of ImageShowProjet objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ImageShowProjet
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
