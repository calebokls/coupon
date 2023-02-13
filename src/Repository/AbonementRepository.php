<?php

namespace App\Repository;

use App\Entity\Abonement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Abonement>
 *
 * @method Abonement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Abonement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Abonement[]    findAll()
 * @method Abonement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AbonementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Abonement::class);
    }

    public function save(Abonement $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Abonement $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Abonement[] Returns an array of Abonement objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Abonement
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

public function FindByUser(): array
  {
       return $this->createQueryBuilder('a')
                    ->select('a.username,a.email')
                    ->join('user','u')
                    ->where('a.datedebut != a.dateFin')
                    ->getQuery()
                    ->getResult()
                ;
   }
}
