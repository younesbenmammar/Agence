<?php

namespace App\Repository;

use App\Entity\BienRecherche;
use App\Entity\Biens;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
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

    /**
     * @param BienRecherche $recherche
     * @return Query
     */
    public function findAllVisibleQuery(BienRecherche $recherche): Query
    {
        $query = $this->findVisibleQuery();

        if ($recherche->getPrixMax()){
            $query = $query
                ->andWhere('p.prix <= :maxprix')
                ->setParameter('maxprix', $recherche->getPrixMax());

        }
        if ($recherche->getSurfaceMin()){
            $query = $query
                ->andWhere('p.surface >= :minsurface')
                ->setParameter('minsurface', $recherche->getSurfaceMin());

        }
        return $query->getQuery();

    }


    /**
     * @return Biens[]
     */
    public function findAllVisible(): array {
        return $this->findVisibleQuery()
            ->getQuery()
            ->getResult();

    }




    /**
     * @return Biens[]
     */
    public function findDernier(){

        return $this->findVisibleQuery()
        ->setMaxResults(4)
        ->getQuery()
        ->getResult();
    }


    private function findVisibleQuery(): QueryBuilder{
        return $this->createQueryBuilder('p')
            ->where('p.disponible = true');


    }




}
