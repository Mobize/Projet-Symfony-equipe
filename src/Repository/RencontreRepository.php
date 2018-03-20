<?php

namespace App\Repository;

use App\Entity\Rencontre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Rencontre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rencontre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rencontre[]    findAll()
 * @method Rencontre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RencontreRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Rencontre::class);
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('r')
            ->where('r.something = :value')->setParameter('value', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
    
       public function afficheLesRencontres()
    {
        $connection=$this->getEntityManager()->getConnection();
        $sql="SELECT REN.equipe1_id, REN.equipe2_id, REN.lieu, REN.date, EQ1.nom as equipe_domicile,EQ2.nom as equipe_exterieur
                FROM rencontre REN
                INNER JOIN equipe EQ1 ON EQ1.id =REN.equipe1_id
                INNER JOIN equipe EQ2 ON EQ2.id =REN.equipe2_id";
        $resultat=$connection->query($sql);
        return $resultat->fetchAll();
    }
}
