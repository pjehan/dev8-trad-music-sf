<?php

namespace App\Repository;

use App\Entity\Gig;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Gig>
 *
 * @method Gig|null find($id, $lockMode = null, $lockVersion = null)
 * @method Gig|null findOneBy(array $criteria, array $orderBy = null)
 * @method Gig[]    findAll()
 * @method Gig[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GigRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Gig::class);
    }

    public function save(Gig $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Gig $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findFuture(int $limit = 4): array
    {
        // SELECT * FROM gig WHERE date_start > NOW() ORDER BY date_start ASC LIMIT 4
        return $this->createQueryBuilder('gig')
            ->addSelect('pub')
            ->join('gig.pub', 'pub') // INNER JOIN pub ON pub.id = gig.pub_id
            ->where('gig.dateStart > :today')
            ->orderBy('gig.dateStart', 'ASC')
            ->setMaxResults($limit)
            ->setParameter(':today', new \DateTime())
            ->getQuery()
            ->getResult()
        ;
    }

//    /**
//     * @return Gig[] Returns an array of Gig objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('g.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Gig
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
