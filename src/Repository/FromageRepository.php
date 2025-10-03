<?php

namespace App\Repository;

use App\Entity\Fromage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Fromage>
 *
 * @method Fromage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Fromage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Fromage[]    findAll()
 * @method Fromage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FromageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Fromage::class);
    }
}
