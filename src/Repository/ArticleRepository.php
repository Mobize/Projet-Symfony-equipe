<?php

namespace App\Repository;

use App\Entity\Article;
use App\Entity\Rencontre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Article::class);
    }
    
  /*fonction pour récupérer les valeurs dans d'autres entités*/  

  public function findByRencontre(Rencontre $rencontre) {
        $qb = $this->createQueryBuilder('a')
                ->join('a.rencontre', 'r')
                ->where('r.id = :rencontre')
                ->setParameter('rencontre', $rencontre->getId());
        //dump($qb);
        // try {
        return $qb->getQuery()->getResult();  
    
  }
         // Example - $qb->join('u.Group', 'g', 'WITH', 'u.status = ?1')
    // Example - $qb->join('u.Group', 'g', 'WITH', 'u.status = ?1', 'g.id')
  /*  public function join($join, $alias, $conditionType = null, $condition = null, $indexBy = null){
        
    }
    
    /*public function findBySomething($value)
    {
        return $this->createQueryBuilder('a')
            ->where('a.something = :value')->setParameter('value', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
