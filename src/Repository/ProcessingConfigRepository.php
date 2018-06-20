<?php

namespace App\Repository;

use App\Entity\ProcessingConfig;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ProcessingConfig|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProcessingConfig|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProcessingConfig[]    findAll()
 * @method ProcessingConfig[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProcessingConfigRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ProcessingConfig::class);
    }

//    /**
//     * @return ProcessingConfig[] Returns an array of ProcessingConfig objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ProcessingConfig
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
