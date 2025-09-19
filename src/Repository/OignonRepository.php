<?php

namespace App\Repository;

use App\Entity\Oignon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Oignon>
 *
 * @method Oignon|null find($id, $lockMode = null, $lockVersion = null)
 * @method Oignon|null findOneBy(array $criteria, array $orderBy = null)
 * @method Oignon[]    findAll()
 * @method Oignon[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OignonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Oignon::class);
    }
}
