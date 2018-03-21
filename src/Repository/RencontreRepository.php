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
    
    
    /*     public function ArticlesSaisonClub($club,$saison)
    {
        $connection=$this->getEntityManager()->getConnection();
        $statement = $connection->prepare("SELECT art.id as id_art, art.*, ren.* FROM article ART INNER JOIN rencontre REN ON REN.ID = ART.rencontre_id INNER JOIN saison SAI ON SAI.ID = ART.saison_id WHERE ART.club_id=:club_id AND ART.saison_id=:saison_id");
        $statement->bindValue('club_id', $club,PDO::PARAM_INT);
        $statement->bindValue('saison_id', PDO::PARAM_INT);
        $statement->execute();
        $results = $statement->fetchAll();
        return $results;
    } */
}
