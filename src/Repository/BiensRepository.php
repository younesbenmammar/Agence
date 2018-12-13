<?php

namespace App\Repository;

use App\Entity\Biens;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Biens|null find($id, $lockMode = null, $lockVersion = null)
 * @method Biens|null findOneBy(array $criteria, array $orderBy = null)
 * @method Biens[]    findAll()
 * @method Biens[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BiensRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Biens::class);
    }

    public function findByDsiponible(){

        return $this->createQueryBuilder('b')
        ->where('b.disponible = true')
        ->getQuery()
        ->getResult();
    }

    public function findDernier(){

        return $this->createQueryBuilder('b')
        ->where('b.disponible = true')
        ->setMaxResults(4)
        ->getQuery()
        ->getResult();
    }

    // /**
    //  * @return Biens[] Returns an array of Biens objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Biens
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
