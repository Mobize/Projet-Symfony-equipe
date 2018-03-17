<?php

namespace App\Controller;

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
        
        //requete Ã  partir de SaisonRepository pour savoir si le club connectÃ©
        //a dÃ©jÃ  une saison en base
        //rÃ©cupÃ©ration des saisons du club si connectÃ©
        if(!is_null($this->getUser())){
            $saisonRepository = $this->getDoctrine()->getRepository(Saison::class);
            $saisons = $saisonRepository->listSaisonClub($this->getUser()->getClub()->getId());
            $nbsaison = count($saisons);
            
            //dump($nbsaison);
        } else {
            $nbsaison = 0;
        }
       
        return $this->render(
                'index/index.html.twig',
                [
                  'nomClub' => $nomClub,
                  'nbsaisons' => $nbsaison
                ]
        );
    }
    

}
