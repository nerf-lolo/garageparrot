<?php

namespace App\Repository;

use App\Data\SearchData;
use App\Entity\Car;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Car>
 *
 * @method Car|null find($id, $lockMode = null, $lockVersion = null)
 * @method Car|null findOneBy(array $criteria, array $orderBy = null)
 * @method Car[]    findAll()
 * @method Car[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Car::class);
    }
    // recupèreles produit en lien avec la recherche
    public function findSearch(SearchData $search): array
    {
        $query = $this->createQueryBuilder('car');

        if (!empty($search->q)) {
            $query = $query
                ->andWhere('car.brand LIKE :q')
                ->setParameter('q', "%{$search->q}%");
        }

        if (!empty($search->minPrice)) {
            $query = $query
                ->andWhere('car.price >= :minPrice')
                ->setParameter('minPrice', $search->minPrice);
        }

        if (!empty($search->maxPrice)) {
            $query = $query
                ->andWhere('car.price <= :maxPrice')
                ->setParameter('maxPrice', $search->maxPrice);
        }

        if (!empty($search->minYear)) {
            $query = $query
                ->andWhere('car.year >= :minYear')
                ->setParameter('minYear', $search->minYear);
        }

        if (!empty($search->maxYear)) {
            $query = $query
                ->andWhere('car.year <= :maxYear')
                ->setParameter('maxYear', $search->maxYear);
        }

        if (!empty($search->minKm)) {
            $query = $query
                ->andWhere('car.car_km >= :minKm')
                ->setParameter('minKm', $search->minKm);
        }

        if (!empty($search->maxKm)) {
            $query = $query
                ->andWhere('car.car_km <= :maxKm')
                ->setParameter('maxKm', $search->maxKm);
        }

        return $query->getQuery()->getResult();
    }
}
