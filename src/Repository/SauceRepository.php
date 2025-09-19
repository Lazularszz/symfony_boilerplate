<?php

namespace App\Repository;

use App\Entity\Sauce;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Sauce>
 *
 * @method Sauce|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sauce|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sauce[]    findAll()
 * @method Sauce[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SauceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sauce::class);
    }
}
