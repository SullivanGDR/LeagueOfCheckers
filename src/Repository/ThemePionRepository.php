<?php

namespace App\Repository;

use App\Entity\ThemePion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ThemePion>
 *
 * @method ThemePion|null find($id, $lockMode = null, $lockVersion = null)
 * @method ThemePion|null findOneBy(array $criteria, array $orderBy = null)
 * @method ThemePion[]    findAll()
 * @method ThemePion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ThemePionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ThemePion::class);
    }

//    /**
//     * @return ThemePion[] Returns an array of ThemePion objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ThemePion
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
