<?php

namespace App\Repository;

use App\Entity\Education;
use App\Entity\Resume;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Resume>
 *
 * @method Resume|null find($id, $lockMode = null, $lockVersion = null)
 * @method Resume|null findOneBy(array $criteria, array $orderBy = null)
 * @method Resume[]    findAll()
 * @method Resume[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResumeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Resume::class);
    }

    public function save(Resume $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Resume $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function createResume(array $params, Resume $resume): Resume
    {



        $resume
            ->setProfession($params['profession'])
            ->setCity($params['city'])
            ->setPhoto($params['photo'])
            ->setSurname($params['surname'])
            ->setName($params['name'])
            ->setPatronymic($params['patronymic'])
            ->setPhone($params['phone'])
            ->setMail($params['mail'])
            ->setBDate($params['bDate'])
            ->setMoney($params['money'])
            ->setSkills($params['skills'])
            ->setAbout($params['about'])
            ->setStatus($params['status'])
        ;
//            ->addEducation(null);

        return $resume;
    }
//    /**
//     * @return Resume[] Returns an array of Resume objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Resume
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
