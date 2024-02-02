<?php

namespace App\Repository;

use App\Entity\DocSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DocSearch>
 *
 * @method DocSearch|null find($id, $lockMode = null, $lockVersion = null)
 * @method DocSearch|null findOneBy(array $criteria, array $orderBy = null)
 * @method DocSearch[]    findAll()
 * @method DocSearch[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DocSearchRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DocSearch::class);
    }

//    /**
//     * @return DocSearch[] Returns an array of DocSearch objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?DocSearch
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
