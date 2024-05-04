<?php

namespace App\Repository;

use App\Entity\JugadoresDestacados;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<JugadoresDestacados>
 *
 * @method JugadoresDestacados|null find($id, $lockMode = null, $lockVersion = null)
 * @method JugadoresDestacados|null findOneBy(array $criteria, array $orderBy = null)
 * @method JugadoresDestacados[]    findAll()
 * @method JugadoresDestacados[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JugadoresDestacadosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, JugadoresDestacados::class);
    }

//    /**
//     * @return JugadoresDestacados[] Returns an array of JugadoresDestacados objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('j')
//            ->andWhere('j.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('j.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?JugadoresDestacados
//    {
//        return $this->createQueryBuilder('j')
//            ->andWhere('j.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
