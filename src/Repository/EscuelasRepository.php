<?php

namespace App\Repository;

use App\Entity\Escuelas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Escuelas>
 *
 * @method Escuelas|null find($id, $lockMode = null, $lockVersion = null)
 * @method Escuelas|null findOneBy(array $criteria, array $orderBy = null)
 * @method Escuelas[]    findAll()
 * @method Escuelas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EscuelasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Escuelas::class);
    }

//    /**
//     * @return Escuelas[] Returns an array of Escuelas objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Escuelas
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}