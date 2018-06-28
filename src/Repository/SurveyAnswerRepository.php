<?php

namespace App\Repository;

use App\Entity\SurveyAnswer;
use App\Entity\SurveyPoll;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SurveyAnswer|null find($id, $lockMode = null, $lockVersion = null)
 * @method SurveyAnswer|null findOneBy(array $criteria, array $orderBy = null)
 * @method SurveyAnswer[]    findAll()
 * @method SurveyAnswer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SurveyAnswerRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SurveyAnswer::class);
    }

//    /**
//     * @return SurveyAnswer[] Returns an array of SurveyAnswer objects
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
    public function findOneBySomeField($value): ?SurveyAnswer
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findMostAnswers(SurveyPoll $poll)
    {
        $qb = $this->createQueryBuilder("a");
        $qb->select("a, count(a.id) as nbAnswer")
            ->join("a.surveyPoll", 'p')
            ->where($qb->expr()->eq("p.id", $poll->getId()))
            ->groupBy("a.pollAnswer")
            ->orderBy("nbAnswer", "DESC")->setMaxResults(1);
        return $qb->getQuery()->getSingleResult();
    }
}
