<?php
namespace App\Repository;

use App\Entity\Article;
use App\Entity\Rencontre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
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
        parent::__construct($registry, Article::class, Rencontre::class);
    }

    // Articles d'une rencontre d'une saison donnée pour un club donné
    /*public function ArticlesSaisonClub($club,$saison)
    {
        return $this->createQueryBuilder('article')
            ->innerJoin('article.rencontre', 'article_rencontre',Join::WITH,'article_rencontre.id = rencontre.id')
            ->where('article.club = :club')->setParameter('club',$club)
            ->andWhere('article.saison = :saison')->setParameter('saison',$saison)    
            ->getQuery()
            ->getResult();
    }*/  

      public function ArticlesSaisonClub($club,$saison)
    {
        $connection=$this->getEntityManager()->getConnection();
        $sql="SELECT * FROM article ART INNER JOIN rencontre REN ON REN.ID = ART.rencontre_id";
                
        $resultat=$connection->query($sql);
        return $resultat->fetchAll();
    }
    
    
    /*public function ArticlesRencontreSaisonClub($club,$saison,$rencontre=null)
    {
        return $this->createQueryBuilder('a')
            ->where('a.club = :club')->setParameter('club',$club)
            ->andWhere('a.saison = :saison')->setParameter('saison',$saison)
            ->andWhere('a.rencontre = :rencontre')->setParameter('rencontre',$rencontre)    
            ->getQuery()
            ->getResult();
    }*/  


    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('e')
            ->where('e.something = :value')->setParameter('value', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
     *   public function afficheLesCommentairesRecents($limit)
    {
        $connection=$this->getEntityManager()->getConnection();
        $sql="SELECT c.membre,c.commentaire,r.nom AS restaraunt FROM commentaire c,restaraunt r WHERE c.restaraunt_id=r.id GROUP BY r.nom LIMIT 0,$limit";
        $resultat=$connection->query($sql);
        return $resultat->fetchAll();
    }
    
     * 
     * 
     */
    
    
    }

