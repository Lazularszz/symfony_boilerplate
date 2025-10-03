<?php

namespace App\Repository;

use App\Entity\Burger;
use App\Entity\Oignon;
use App\Entity\Pain;
use App\Entity\Sauce;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Burger>
 *
 * @method Burger|null find($id, $lockMode = null, $lockVersion = null)
 * @method Burger|null findOneBy(array $criteria, array $orderBy = null)
 * @method Burger[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BurgerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Burger::class);
    }

    private function addJoins(QueryBuilder $qb): QueryBuilder
    {
        return $qb
            ->leftJoin('b.image', 'i')
            ->addSelect('i')
            ->leftJoin('b.commentaires', 'c')
            ->addSelect('c')
            ->leftJoin('b.oignons', 'o')
            ->addSelect('o')
            ->leftJoin('b.sauces', 's')
            ->addSelect('s')
            ->leftJoin('b.fromages', 'f')
            ->addSelect('f');
    }

    public function findBurgerWithDetails(int $id): ?Burger
    {
        $qb = $this->createQueryBuilder('b')->distinct();
        $this->addJoins($qb);
        $qb->andWhere('b.id = :id');
        $qb->setParameter('id', $id);
        return $qb->getQuery()->getOneOrNullResult();
    }

    public function findAll(): array
    {
        $qb = $this->createQueryBuilder('b')->distinct();
        $this->addJoins($qb);
        return $qb->getQuery()->getResult();
    }

    /**
     * @return Burger[]
     */
    public function findBurgersWithIngredient(string $ingredientName, string $ingredientType): array
    {
        $qb = $this->createQueryBuilder('b')->distinct();

        switch ($ingredientType) {
            case 'oignon':
                $qb->innerJoin('b.oignons', 'o')
                    ->andWhere('o.name = :name');
                break;
            case 'sauce':
                $qb->innerJoin('b.sauces', 's')
                    ->andWhere('s.name = :name');
                break;
            case 'pain':
                $qb->innerJoin('b.pain', 'p')
                    ->andWhere('p.name = :name');
                break;
            default:
                return [];
        }

        $this->addJoins($qb);
        return $qb->setParameter('name', $ingredientName)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Burger[]
     */
    public function findTopXBurgers(int $limit): array
    {
        $qb = $this->createQueryBuilder('b')
            ->distinct()
            ->orderBy('b.price', 'DESC')
            ->setMaxResults($limit);
        
        $this->addJoins($qb);
        return $qb->getQuery()->getResult();
    }

    public function findBurgersWithoutIngredient(object $ingredient): array
    {
        $qb = $this->createQueryBuilder('b')->distinct();
        $entityClass = get_class($ingredient);

        switch ($entityClass) {
            case Oignon::class:
                $qb->andWhere(':ingredient NOT MEMBER OF b.oignons')
                    ->setParameter('ingredient', $ingredient);
                break;
            case Sauce::class:
                $qb->andWhere(':ingredient NOT MEMBER OF b.sauces')
                    ->setParameter('ingredient', $ingredient);
                break;
            case Pain::class:
                $qb->andWhere('b.pain != :ingredient')
                    ->setParameter('ingredient', $ingredient);
                break;
        }

        $this->addJoins($qb);
        return $qb->getQuery()->getResult();
    }

    public function findBurgersWithMinimumIngredients(int $minIngredients): array
    {
        $qb = $this->createQueryBuilder('b')->distinct();
        $qb->where('(SIZE(b.oignons) + SIZE(b.sauces) + (CASE WHEN b.pain IS NOT NULL THEN 1 ELSE 0 END)) >= :minIngredients')
            ->setParameter('minIngredients', $minIngredients);

        $this->addJoins($qb);
        return $qb->getQuery()->getResult();
    }
}
