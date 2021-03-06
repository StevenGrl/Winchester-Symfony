<?php

namespace App\Repository;

use App\Entity\Article;
use App\Entity\Theme;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    public function findOnlyPublishedWithPaging(int $currentPage, int $nbPerPage)
    {
        $query = $this->createQueryBuilder('a')
            ->where('a.isPublished = true')
//            ->orderBy('a.created_at', 'DESC')
//            ->leftJoin('a.comments', 'c')
//            ->leftJoin('a.categories', 'cat')
//            ->addSelect('c')
//            ->addSelect('cat')
//            ->addOrderBy('c.created_at', 'DESC')
            ->setFirstResult(($currentPage - 1) * $nbPerPage)
            ->setMaxResults($nbPerPage);

        return new Paginator($query);
    }

    public function findOnlyPublishedByTheme(Theme $theme, int $currentPage, int $nbPerPage)
    {
        $query = $this->createQueryBuilder('a')
            ->where('a.isPublished = true')
            ->andWhere('t = :theme')
//            ->orderBy('a.created_at', 'DESC')
            ->leftJoin('a.theme', 't')
            ->leftJoin('a.theme', 'theme')
//            ->leftJoin('a.comments', 'com')
            ->addSelect('theme')
//            ->addSelect('com')
            ->setParameter(':theme', $theme)
            ->setFirstResult(($currentPage - 1) * $nbPerPage)
            ->setMaxResults($nbPerPage);
        ;

        return new Paginator($query);
    }

    // /**
    //  * @return Article[] Returns an array of Article objects
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
    public function findOneBySomeField($value): ?Article
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
