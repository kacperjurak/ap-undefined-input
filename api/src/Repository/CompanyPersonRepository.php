<?php

namespace App\Repository;

use App\Entity\CompanyPerson;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CompanyPerson|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompanyPerson|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompanyPerson[]    findAll()
 * @method CompanyPerson[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompanyPersonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CompanyPerson::class);
    }

    // /**
    //  * @return CompanyPerson[] Returns an array of CompanyPerson objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CompanyPerson
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
