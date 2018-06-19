<?php

namespace App\Repository;

use App\Entity\SurveyPoll;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SurveyPoll|null find($id, $lockMode = null, $lockVersion = null)
 * @method SurveyPoll|null findOneBy(array $criteria, array $orderBy = null)
 * @method SurveyPoll[]    findAll()
 * @method SurveyPoll[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SurveyPollRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SurveyPoll::class);
    }

//    /**
//     * @return SurveyPoll[] Returns an array of SurveyPoll objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SurveyPoll
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
