<?php

namespace App\Repository;

use App\Entity\DocSearch;
use App\Entity\Document;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Document>
 *
 * @method Document|null find($id, $lockMode = null, $lockVersion = null)
 * @method Document|null findOneBy(array $criteria, array $orderBy = null)
 * @method Document[]    findAll()
 * @method Document[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DocumentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Document::class);
    }

    /**
     * @return Document[] Returns an array of Document objects
     */
    public function findBySearchCriteria(DocSearch $docSearch): array
    {
        $result = $this->createQueryBuilder('d');

        $searchedTypes = $docSearch->getType();
        if (!is_null($searchedTypes)) {
            foreach ($searchedTypes as $type) {
                if ($type === reset($searchedTypes)) {
                    $result->andWhere('d.type = :type');
                } else {
                    $result->orWhere('d.type = :type');
                }
                $result->setParameter('type', $type);
            }
        }

        if (!is_null($docSearch->getLevel())) {
            $result->andWhere('d.level = :level')
                ->setParameter('level', $docSearch->getLevel());
        }

        if (!is_null($docSearch->getSubject())) {
            $result->andWhere('d.subject = :subject')
                ->setParameter('subject', $docSearch->getSubject());
        }

        if (!is_null($docSearch->getTheme())) {
            $result->andWhere('d.theme = :theme')
                ->setParameter('theme', $docSearch->getTheme());
        }

        if (!is_null($docSearch->getDocumentTitle())) {
            $result->andWhere($result->expr()->like('d.title', ':title'))
                ->setParameter('title', $docSearch->getTheme());
        }

        return $result->orderBy('d.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    //    public function findOneBySomeField($value): ?Document
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
