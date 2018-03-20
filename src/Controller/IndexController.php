<?php

namespace App\Controller;

use App\Entity\Rencontre;
use App\Entity\Saison;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;



class IndexController extends Controller
{
    /**
     * @Route("/")
     */
    public function index()
    {
        if($this->getUser()){
          $nomClub = $this->getUser()->getClub()->getNom();  
        } else {
            $nomClub ='';
        }
        
        //requete à partir de SaisonRepository pour savoir si le club connecté
        //a déjà une saison en base
        //récupération des saisons du club si connecté
        if(!is_null($this->getUser())){
            $saisonRepository = $this->getDoctrine()->getRepository(Saison::class);
            $saisons = $saisonRepository->listSaisonClub($this->getUser()->getClub()->getId());
            $nbsaison = count($saisons);
            
            //dump($nbsaison);
        } else {
            $nbsaison = 0;
        }
        
        $RencontreRepository = $this->getDoctrine()->getRepository(Rencontre::class);
        $rencontres= $RencontreRepository->afficheLesRencontres();
        
       
        return $this->render(
                'index/index.html.twig',
                [
                  'nomClub' => $nomClub,
                  'nbsaisons' => $nbsaison,
                  'rencontres' => $rencontres
                ]
        );
    }
    
    
    

}
