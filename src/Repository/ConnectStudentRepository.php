<?php

namespace App\Repository;

use App\Entity\ConnectStudent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ConnectStudent|null find($id, $lockMode = null, $lockVersion = null)
 * @method ConnectStudent|null findOneBy(array $criteria, array $orderBy = null)
 * @method ConnectStudent[]    findAll()
 * @method ConnectStudent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConnectStudentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ConnectStudent::class);
    }

    // /**
    //  * @return ConnectStudent[] Returns an array of ConnectStudent objects
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
    public function findOneBySomeField($value): ?ConnectStudent
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
