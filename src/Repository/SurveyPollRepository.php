<?php

namespace App\Repository;

use App\Entity\SurveyPoll;
use App\Entity\User;
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

    /**
     * @param User $user
     * @return SurveyPoll[]
     */
    public function findAllSurveys(User $user)
    {
        $qb2 = $this->createQueryBuilder('s2')
            ->select('s2.id')
            ->join('s2.surveyAnswers', 'a')
            ->join('a.user', 'u')
            ->where('u.id = :id')
            ;

        $qb = $this->createQueryBuilder('s');
        $qb->where($qb->expr()->notIn('s.id', $qb2->getDQL()))
            ->setParameter('id', $user->getId());

        return $qb->getQuery()->getResult();
    }
}
